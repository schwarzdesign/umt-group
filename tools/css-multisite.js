#!/usr/bin/env node
// tools/css-multisite.js
import { spawn } from "node:child_process";
import { readdirSync, statSync, existsSync, mkdirSync } from "node:fs";
import { join, resolve } from "node:path";

const MODE = process.argv[2] === "watch" ? "watch" : "build";
const PROJECT_ROOT = resolve(process.cwd());
const SRC_SITES_DIR = resolve(PROJECT_ROOT, "src/css/sites");
const CONTENT_SITES_DIR = resolve(PROJECT_ROOT, "content-multisites");
const OUT_DIR = resolve(PROJECT_ROOT, "public/assets/css");

function log(...args) {
  console.log("[css-multisite]", ...args);
}

function listDirs(dir) {
  if (!existsSync(dir)) return [];
  return readdirSync(dir).filter(name => {
    const p = join(dir, name);
    return name !== "." && name !== ".." && statSync(p).isDirectory();
  });
}

function listSiteEntries() {
  if (!existsSync(SRC_SITES_DIR)) return [];
  return readdirSync(SRC_SITES_DIR)
    .filter(f => f.endsWith(".css"))
    .map(f => f.replace(/\.css$/, ""));
}

function intersect(a, b) {
  const B = new Set(b);
  return a.filter(x => B.has(x));
}

function runTailwind({ input, output, mode }) {
  const args = ["tailwindcss", "-i", input, "-o", output];
  if (mode === "build") args.push("-m");
  if (mode === "watch") args.push("-w");

  log(`${mode.toUpperCase()}: ${input} → ${output}`);
  const child = spawn("npx", args, {
    stdio: "inherit",
    shell: process.platform === "win32"
  });
  return child;
}

function ensureOutDir() {
  if (!existsSync(OUT_DIR)) mkdirSync(OUT_DIR, { recursive: true });
}

async function main() {
  ensureOutDir();

  // 1) Ermittele gültige Sites: nur wenn Content-Ordner UND Entry-CSS existieren
  const contentSites = listDirs(CONTENT_SITES_DIR);          // z.B. ['abc', 'me', ...]
  const entrySites = listSiteEntries();                      // z.B. ['abc']
  const sitesToBuild = intersect(entrySites, contentSites);  // z.B. ['abc']

  if (sitesToBuild.length === 0) {
    log("Keine passenden Site-CSS Einträge gefunden (kein Match zwischen src/css/sites/* und content-multisites/*).");
    if (MODE === "build") process.exit(0);
  }

  // 2) Für jede Site einen Tailwind-Prozess starten
  const children = sitesToBuild.map(site => {
    const input = resolve(SRC_SITES_DIR, `${site}.css`);
    const output = resolve(OUT_DIR, `${site}.css`);
    return runTailwind({ input, output, mode: MODE });
  });

  if (MODE === "build") {
    // Auf Fertigstellung warten
    await Promise.all(
      children.map(
        child =>
          new Promise((resolveP, rejectP) => {
            child.on("exit", code => (code === 0 ? resolveP() : rejectP(new Error(`exit ${code}`))));
          })
      )
    );
  } else {
    // watch: Prozesse laufen lassen
    process.on("SIGINT", () => {
      children.forEach(ch => ch.kill("SIGINT"));
      process.exit(0);
    });
  }
}

main().catch(err => {
  console.error(err);
  process.exit(1);
});
