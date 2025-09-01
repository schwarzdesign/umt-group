#!/usr/bin/env node
// tools/css-multisite.js
import { spawn } from "node:child_process";
import { readdirSync, existsSync, mkdirSync } from "node:fs";
import { resolve } from "node:path";

const MODE = process.argv[2] === "watch" ? "watch" : "build";
const ROOT = resolve(process.cwd());
const SRC_SITES_DIR = resolve(ROOT, "src/css/sites");
const OUT_DIR = resolve(ROOT, "public/assets/css");

function log(...args) {
  console.log("[css-multisite]", ...args);
}

function ensureOutDir() {
  if (!existsSync(OUT_DIR)) mkdirSync(OUT_DIR, { recursive: true });
}

function listSiteCss() {
  if (!existsSync(SRC_SITES_DIR)) return [];
  return readdirSync(SRC_SITES_DIR)
    .filter((f) => f.endsWith(".css"))
    .map((f) => ({
      name: f.replace(/\.css$/, ""),
      input: resolve(SRC_SITES_DIR, f),
      output: resolve(OUT_DIR, `${f.replace(/\.css$/, "")}.css`),
    }));
}

function runTailwind({ input, output, mode }) {
  const args = ["@tailwindcss/cli", "-i", input, "-o", output];
  if (mode === "build") args.push("-m");
  if (mode === "watch") args.push("-w");

  log(`${mode.toUpperCase()}: ${input} → ${output}`);
  return spawn("npx", args, { stdio: "inherit", shell: process.platform === "win32" });
}

async function main() {
  ensureOutDir();

  const entries = listSiteCss();
  if (entries.length === 0) {
    log("Keine site-spezifischen CSS-Dateien in src/css/sites/*.css gefunden.");
    process.exit(0);
  }

  const children = entries.map(({ input, output }) => runTailwind({ input, output, mode: MODE }));

  if (MODE === "build") {
    await Promise.all(
      children.map(
        (child) =>
          new Promise((resolveP, rejectP) => {
            child.on("exit", (code) => (code === 0 ? resolveP() : rejectP(new Error(`exit ${code}`))));
          }),
      ),
    );
  } else {
    process.on("SIGINT", () => {
      children.forEach((ch) => ch.kill("SIGINT"));
      process.exit(0);
    });
  }
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});
