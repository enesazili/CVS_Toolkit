<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSV Toolkit — CSV görüntüleme</title>
    <style>
:root {
    --bg: #fbf7ed;
    --surface: #f2ead8;
    --surface-raised: #f6efe0;
    --ink: #282828;
    --ink-soft: #46433d;
    --muted: #6b665c;
    --line: #ded5c3;
    --line-strong: #c8bca6;
    --accent: #a4481f;
    --accent-soft: #f0dccb;
    --olive: #5b6a3d;
    --focus: #8d3a16;
    --selection: #e9d3bf;
    --font-sans: "Segoe UI", system-ui, -apple-system, "Helvetica Neue", Arial, sans-serif;
    --font-serif: "Iowan Old Style", "Palatino Linotype", Palatino, "Book Antiqua", Georgia, serif;
    --font-mono: "Cascadia Mono", ui-monospace, SFMono-Regular, Consolas, "Liberation Mono", monospace;
    --container: 1160px;
    --gutter: clamp(1.25rem, 4vw, 2.5rem);
    --radius: 2px;
    --ease: cubic-bezier(.2, .6, .2, 1);
    --speed: 180ms;
    color-scheme: light;
}

@media (prefers-color-scheme: dark) {
    :root {
        --bg: #0d1117;
        --surface: #161b22;
        --surface-raised: #1b222c;
        --ink: #e6edf3;
        --ink-soft: #c9d1d9;
        --muted: #9aa4af;
        --line: #30363d;
        --line-strong: #3d444d;
        --accent: #79b8ff;
        --accent-soft: #16283c;
        --olive: #8fbf7f;
        --focus: #a5d6ff;
        --selection: #1f3a56;
        color-scheme: dark;
    }
}

*, *::before, *::after { box-sizing: border-box; }
html { -webkit-text-size-adjust: 100%; }
body {
    margin: 0;
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-sans);
    font-size: 1rem;
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
}
main { display: block; }
h1, h2, h3 { color: var(--ink); text-wrap: balance; }
p { margin-top: 0; }
a { color: var(--accent); text-decoration-thickness: 1px; text-underline-offset: .18em; }
[hidden] { display: none !important; }
::selection { background: var(--selection); color: var(--ink); }

.container {
    width: 100%;
    max-width: var(--container);
    margin-inline: auto;
    padding-inline: var(--gutter);
}

.section { padding-block: clamp(2.25rem, 5vw, 3.75rem); }

.row { display: flex; flex-wrap: wrap; margin-inline: -.75rem; }
.row > * { width: 100%; padding-inline: .75rem; }

@media (min-width: 992px) {
    .col-lg-4 { width: 33.3333%; }
    .col-lg-5 { width: 41.6667%; }
    .col-lg-7 { width: 58.3333%; }
    .col-lg-8 { width: 66.6667%; }
    .offset-lg-1 { margin-left: 8.3333%; }
}

.section__label {
    margin-bottom: 1.15rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .67rem;
    letter-spacing: .14em;
    line-height: 1.5;
    text-transform: uppercase;
}

.section__num { margin-right: .45rem; color: var(--accent); }

.section__title {
    margin: 0 0 1.25rem;
    font-family: var(--font-serif);
    font-size: clamp(2rem, 3.8vw, 3rem);
    font-weight: 400;
    line-height: 1.06;
    letter-spacing: -.03em;
}

.section__intro {
    max-width: 36rem;
    margin-bottom: 1.5rem;
    color: var(--ink-soft);
    font-size: .98rem;
    line-height: 1.7;
}

.visually-hidden {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

:where(a, button, [tabindex]):focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 3px;
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}
/* ==========================================================================
   Tarayıcı araçları — Image Toolkit, Dev Toolbox, Text Diff, CSV, QR Studio
   Renkler site.css tokenlarından gelir; iki tema da desteklenir.
   ========================================================================== */

:root {
    --tool-add-bg: #e6efdb;
    --tool-add-ink: #2f4a1f;
    --tool-del-bg: #f7e2d8;
    --tool-del-ink: #7a2c10;
    --tool-change-bg: #f4e8c8;
    --tool-change-ink: #6b4a0f;
    --tool-warn-bg: #f6ecd2;
    --tool-warn-line: #a56a14;
}

[data-theme="dark"] {
    --tool-add-bg: #14261a;
    --tool-add-ink: #b8e6b0;
    --tool-del-bg: #2b1512;
    --tool-del-ink: #ffc2ad;
    --tool-change-bg: #2a2311;
    --tool-change-ink: #f0d491;
    --tool-warn-bg: #2a2311;
    --tool-warn-line: #d4a24a;
}

.site-nav--tool .site-nav__list {
    gap: 1.5rem;
}

.site-nav__label {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.tool .section__intro {
    max-width: 34rem;
}

.tool [hidden] {
    display: none !important;
}

/* Bilgi blokları --------------------------------------------------------- */

.tool-notice {
    margin-top: 2rem;
    padding: 1.35rem 1.4rem;
    border: 1px solid var(--line);
    border-left: 2px solid var(--accent);
    background: var(--surface-raised);
}

.tool-notice__title {
    margin: 0 0 .75rem;
    font-family: var(--font-mono);
    font-size: .74rem;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-notice__list {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--ink-soft);
    font-size: .88rem;
    line-height: 1.6;
}

.tool-notice__list li + li {
    margin-top: .3rem;
}

.tool-meta {
    margin-top: 2rem;
}

.tool-meta__title {
    margin: 0 0 .6rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .09em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-meta__line {
    margin: 0 0 .35rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.tool-meta__key {
    display: inline-block;
    min-width: 7.5rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .05em;
    text-transform: uppercase;
}

.tool-notes {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.6;
}

.tool-notes li + li {
    margin-top: .25rem;
}

.tool-links {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem 1.75rem;
    margin-top: 1.6rem;
}

.tool-noscript {
    margin-top: 1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

/* Paneller, alanlar ve düğmeler ----------------------------------------- */

.tool-panel {
    padding: clamp(1.15rem, 3vw, 1.9rem);
    border: 1px solid var(--line);
    background: var(--surface-raised);
}

.tool-panel + .tool-panel {
    margin-top: 1.25rem;
}

.tool-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem 1.25rem;
}

.tool-grid--three {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.tool-field {
    min-width: 0;
    margin-bottom: 1.1rem;
}

.tool-grid .tool-field {
    margin-bottom: 0;
}

.tool-label,
.tool-legend {
    display: block;
    margin-bottom: .4rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-field__hint,
.tool-hint {
    margin: .45rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.5;
}

.tool-input,
.tool-select,
.tool-textarea {
    width: 100%;
    min-height: 2.75rem;
    padding: .55rem .7rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    color: var(--ink);
    font: inherit;
    font-size: .92rem;
}

.tool-textarea {
    min-height: 10rem;
    resize: vertical;
    font-family: var(--font-mono);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-textarea--short {
    min-height: 6rem;
}

.tool-input:focus-visible,
.tool-select:focus-visible,
.tool-textarea:focus-visible,
.column-toggle input:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-input:disabled,
.tool-select:disabled,
.tool-textarea:disabled {
    opacity: .6;
}

.tool-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .6rem 1rem;
}

.tool-check {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .86rem;
}

.tool-check input {
    width: 1.1rem;
    height: 1.1rem;
    accent-color: var(--accent);
}

.tool-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-top: 1.3rem;
}

.button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 2.75rem;
    padding: .55rem 1.15rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: transparent;
    color: var(--ink);
    font: inherit;
    font-size: .86rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background var(--speed) var(--ease), border-color var(--speed) var(--ease), color var(--speed) var(--ease);
}

.button--primary {
    border-color: var(--accent);
    background: var(--accent);
    color: var(--bg);
}

.button--quiet {
    color: var(--ink-soft);
}

.button:disabled {
    cursor: not-allowed;
    opacity: .55;
}

@media (hover: hover) {
    .button:not(:disabled):hover {
        border-color: var(--accent);
        background: var(--surface);
        color: var(--accent);
    }

    .button--primary:not(:disabled):hover {
        background: var(--ink);
        border-color: var(--ink);
        color: var(--bg);
    }
}

.button:focus-visible,
.dev-tab:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-status {
    min-height: 1.4rem;
    margin: 1rem 0 0;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.tool-status.is-error {
    color: var(--accent);
}

.tool-empty {
    margin: 1rem 0 0;
    padding: 1.25rem;
    border: 1px dashed var(--line-strong);
    color: var(--muted);
    font-size: .88rem;
    line-height: 1.55;
    text-align: center;
}

.tool-warning {
    margin: 1rem 0 0;
    padding: .8rem 1rem;
    border-left: 2px solid var(--tool-warn-line);
    background: var(--tool-warn-bg);
    color: var(--ink-soft);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-output {
    min-height: 7rem;
    max-height: 24rem;
    margin: 0;
    padding: .9rem 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-mono);
    font-size: .82rem;
    line-height: 1.55;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}

.tool-output:empty::before {
    content: "Sonuç burada görünecek.";
    color: var(--muted);
}

/* Dosya bırakma ---------------------------------------------------------- */

.dropzone {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .35rem;
    min-height: 10rem;
    padding: 1.6rem 1.25rem;
    border: 1px dashed var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    text-align: center;
    cursor: pointer;
    transition: border-color var(--speed) var(--ease), background var(--speed) var(--ease);
}

.dropzone:hover,
.dropzone:focus-within {
    border-color: var(--accent);
    background: var(--surface);
}

.dropzone.is-dragover {
    border-style: solid;
    border-color: var(--accent);
    background: var(--accent-soft);
}

.dropzone__icon {
    font-family: var(--font-mono);
    font-size: 1.4rem;
    color: var(--accent);
}

.dropzone__title {
    font-size: .98rem;
    font-weight: 600;
    color: var(--ink);
}

.dropzone__hint {
    max-width: 26rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

.dropzone:focus-within {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Image Toolkit ---------------------------------------------------------- */

.image-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 1.25rem;
}

.image-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
}

.image-preview {
    display: block;
    width: 100%;
    max-width: 34rem;
    height: auto;
    min-height: 9rem;
    margin: 0 auto;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-preview-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.45;
    text-align: center;
}

.image-list {
    margin: 1rem 0 0;
    padding: 0;
    list-style: none;
    border-top: 1px solid var(--line);
}

.image-list:empty {
    border-top: 0;
}

.image-item {
    padding: .9rem .1rem;
    border-bottom: 1px solid var(--line);
}

.image-item__main {
    display: flex;
    align-items: flex-start;
    gap: .9rem;
}

.image-item__text {
    flex: 1 1 auto;
    min-width: 0;
}

.image-thumb {
    flex: 0 0 auto;
    max-width: 104px;
    max-height: 104px;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-item__name {
    margin: 0;
    overflow-wrap: anywhere;
    font-size: .92rem;
    font-weight: 600;
}

.image-item__meta {
    margin: .25rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    line-height: 1.45;
}

.image-item__state {
    margin: .4rem 0 0;
    color: var(--ink-soft);
    font-size: .82rem;
    line-height: 1.45;
}

.image-item__state.is-error {
    color: var(--accent);
}

.image-item__actions {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin-top: .5rem;
}

.image-item__remove {
    min-height: 2.75rem;
    padding: .3rem .65rem;
    border: 1px solid transparent;
    border-radius: var(--radius);
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .78rem;
    cursor: pointer;
}

.image-item__remove:hover,
.image-item__remove:focus-visible {
    border-color: var(--line-strong);
    color: var(--ink);
}

.image-item__remove:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.image-item__result {
    margin: .55rem 0 0;
}

.image-download {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--ink);
    font-size: .86rem;
    font-weight: 600;
    text-decoration: underline;
    text-decoration-color: var(--line-strong);
    text-underline-offset: .25em;
}

.image-download:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Dev Toolbox ------------------------------------------------------------ */

.dev-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin: 0 0 1.1rem;
    padding: 0;
    list-style: none;
    border-bottom: 1px solid var(--line);
}

.dev-tab {
    min-height: 2.75rem;
    padding: .5rem .85rem;
    border: 0;
    border-bottom: 2px solid transparent;
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
}

.dev-tab[aria-selected="true"] {
    border-bottom-color: var(--accent);
    color: var(--ink);
}

.dev-panel {
    min-width: 0;
}

.dev-panel__title {
    margin: 0 0 .5rem;
    font-family: var(--font-serif);
    font-size: 1.3rem;
}

.dev-panel__intro {
    margin: 0 0 1rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.dev-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.dev-output-label {
    display: block;
    margin: 1rem 0 .4rem;
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.dev-jwt-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

/* Text Diff -------------------------------------------------------------- */

.diff-layout {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.diff-summary {
    margin: 1rem 0 0;
    padding: .75rem 1rem;
    border-left: 2px solid var(--accent);
    background: var(--surface);
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.diff-summary.is-error {
    color: var(--accent);
}

.diff-scroll {
    max-height: 34rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.diff-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .78rem;
    line-height: 1.5;
}

.diff-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.diff-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .45rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .05em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
}

.diff-table td {
    padding: .38rem .55rem;
    border-bottom: 1px solid var(--line);
    vertical-align: top;
}

.diff-table__number {
    width: 4.2rem;
    color: var(--muted);
    text-align: right;
    white-space: nowrap;
}

.diff-table__status {
    width: 3.2rem;
    font-weight: 700;
    text-align: center;
}

.diff-table__text {
    overflow-wrap: anywhere;
    white-space: pre-wrap;
}

.diff-row--insert {
    background: var(--tool-add-bg);
    color: var(--tool-add-ink);
}

.diff-row--delete {
    background: var(--tool-del-bg);
    color: var(--tool-del-ink);
}

.diff-row--change {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.diff-row--equal {
    color: var(--ink-soft);
}

.diff-line {
    display: block;
}

.diff-line--removed::before {
    content: "− ";
    font-weight: 700;
}

.diff-line--added::before {
    content: "+ ";
    font-weight: 700;
}

.diff-line--removed {
    text-decoration: line-through;
    text-decoration-thickness: 1px;
}

.diff-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

/* CSV Toolkit ------------------------------------------------------------ */

.csv-controls {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1.1rem;
}

.csv-columns {
    display: flex;
    flex-wrap: wrap;
    gap: .2rem .9rem;
    max-height: 10rem;
    margin: .2rem 0 0;
    padding: .5rem .65rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.column-toggle {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .8rem;
    overflow-wrap: anywhere;
}

.column-toggle input {
    flex: 0 0 auto;
    width: 1rem;
    height: 1rem;
    accent-color: var(--accent);
}

.csv-scroll {
    max-height: 32rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.csv-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .76rem;
    line-height: 1.45;
}

.csv-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.csv-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .5rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--ink-soft);
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    text-align: left;
    white-space: nowrap;
}

.csv-table td {
    max-width: 24rem;
    padding: .42rem .55rem;
    border-bottom: 1px solid var(--line);
    overflow-wrap: anywhere;
    vertical-align: top;
    white-space: pre-wrap;
}

.csv-table__line {
    width: 7rem;
    color: var(--muted);
    white-space: nowrap;
}

.csv-row.is-duplicate {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.csv-duplicate-badge {
    display: inline-block;
    padding: .05rem .3rem;
    border: 1px solid currentColor;
    border-radius: var(--radius);
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .03em;
    text-transform: uppercase;
}

.csv-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

.csv-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .78rem;
    line-height: 1.5;
}

/* QR Studio -------------------------------------------------------------- */

.qr-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(15rem, .85fr);
    gap: 1.25rem;
    align-items: start;
}

.qr-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
    text-align: center;
}

.qr-preview {
    display: block;
    width: 100%;
    max-width: 26rem;
    aspect-ratio: 1 / 1;
    height: auto;
    margin: 0 auto;
    image-rendering: pixelated;
    border: 1px solid var(--line);
    background: var(--surface);
}

.qr-divider {
    margin: 1.2rem 0;
    border: 0;
    border-top: 1px solid var(--line);
}

.qr-size-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .7rem;
    line-height: 1.45;
}

.qr-color-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.qr-color {
    width: 100%;
    min-height: 2.75rem;
    padding: .2rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    cursor: pointer;
}

.qr-color:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Duyarlı ---------------------------------------------------------------- */

@media (max-width: 991.98px) {
    .qr-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767.98px) {
    .tool-grid,
    .tool-grid--three,
    .dev-grid,
    .dev-jwt-grid,
    .diff-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: minmax(0, 1fr);
    }

    .tool-meta__key {
        display: block;
        min-width: 0;
    }

    .image-item__main {
        align-items: stretch;
    }

    .image-thumb {
        max-width: 72px;
        max-height: 72px;
    }
}

@media (max-width: 575.98px) {
    .tool-panel {
        padding: 1rem;
    }

    .tool-actions .button {
        flex: 1 1 auto;
    }

    .diff-table {
        font-size: .72rem;
    }

    .diff-table__number {
        width: 2.6rem;
    }

    .diff-table__status {
        width: 2.2rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    .dropzone,
    .button {
        transition: none;
    }
}

    </style>
</head>
<body>
<main>
<section class="section tool" aria-labelledby="tool-title">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <p class="section__label"><span class="section__num">Araç</span> CSV Toolkit</p>
                <h1 class="section__title" id="tool-title">CSV’yi aç, incele, dışa aktar.</h1>
                <p class="section__intro">
                    Bir CSV dosyasını tarayıcıda görüntüleyin; sütun seçin, sıralayın, arayın,
                    yinelenen ve boş satırları belirleyin.
                </p>

                <div class="tool-notice">
                    <h2 class="tool-notice__title">Ayrıştırma ve dışa aktarma</h2>
                    <ul class="tool-notice__list">
                        <li>Ayrıştırma, filtreleme ve dışa aktarma tarayıcıda çalışan JavaScript ile yapılır.</li>
                        <li>Virgül, noktalı virgül, sekme ve dikey çizgi ayraçları; tırnaklı alanlar ve satır sonları desteklenir.</li>
                        <li>UTF-8 BOM kaldırılır. Dosya en fazla 5 MB, 20.000 satır ve 120 sütun olabilir.</li>
                        <li>Tabloda en fazla 300 satır gösterilir; dışa aktarma tüm eşleşen satırları kapsar.</li>
                    </ul>
                </div>

                <div class="tool-meta">
                    <h2 class="tool-meta__title">Güvenlik</h2>
                    <ul class="tool-notes">
                        <li>Hücreler HTML olarak çalıştırılmaz; tabloya yalnızca metin olarak yazılır.</li>
                        <li>CSV dışa aktarımında =, +, −, @ ile başlayan hücreler varsayılan olarak apostrofla etkisizleştirilir.</li>
                        <li>JSON dışa aktarımı ham değerleri taşır; formül riski elektronik tablo uygulamasında oluşmaz.</li>
                        <li>Yinelenen satırlar tüm hücre değerleri aynı olan satırlar olarak belirlenir.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1">
                <div class="tool-panel" data-csv-form>
                    <label class="dropzone" for="csv-file" data-csv-dropzone>
                        <input class="visually-hidden" id="csv-file" type="file" accept=".csv,text/csv,text/plain">
                        <span class="dropzone__icon" aria-hidden="true">&darr;</span>
                        <span class="dropzone__title">CSV dosyasını seçin veya buraya bırakın</span>
                        <span class="dropzone__hint">UTF-8 · en fazla 5 MB · ayraç otomatik algılanır</span>
                    </label>

                    <p class="tool-empty" data-csv-empty>Henüz dosya yüklenmedi. Bir CSV seçtiğinizde tablo burada görünür.</p>

                    <div data-csv-panel hidden>
                        <div class="csv-controls">
                            <div class="tool-field">
                                <label class="tool-label" for="csv-delimiter">Ayraç</label>
                                <select class="tool-select" id="csv-delimiter">
                                    <option value="auto">Otomatik algıla</option>
                                    <option value=",">Virgül (,)</option>
                                    <option value=";">Noktalı virgül (;)</option>
                                    <option value="&#9;">Sekme</option>
                                    <option value="|">Dikey çizgi (|)</option>
                                </select>
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="csv-sort">Sıralama sütunu</label>
                                <select class="tool-select" id="csv-sort">
                                    <option value="">Sıralama yok</option>
                                </select>
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="csv-sort-direction">Sıra</label>
                                <select class="tool-select" id="csv-sort-direction">
                                    <option value="none">Yok</option>
                                    <option value="asc">Artan</option>
                                    <option value="desc">Azalan</option>
                                </select>
                            </div>
                        </div>

                        <div class="tool-grid">
                            <div class="tool-field">
                                <label class="tool-label" for="csv-search">Ara / filtrele</label>
                                <input class="tool-input" id="csv-search" type="search" placeholder="Tüm seçili sütunlarda ara">
                            </div>
                            <div class="tool-field">
                                <span class="tool-label">Görünüm</span>
                                <label class="tool-check">
                                    <input id="csv-duplicates-only" type="checkbox">
                                    Yalnızca yinelenen satırları göster
                                </label>
                            </div>
                        </div>

                        <fieldset class="tool-field">
                            <legend class="tool-legend">Görünür sütunlar</legend>
                            <div class="csv-columns" data-csv-columns></div>
                            <p class="tool-field__hint">Sütun seçimi tabloyu ve dışa aktarmayı etkiler.</p>
                        </fieldset>

                        <div class="tool-row">
                            <label class="tool-check">
                                <input id="csv-mitigate" type="checkbox" checked>
                                CSV’de formül enjeksiyonunu etkisizleştir
                            </label>
                            <button class="button button--quiet" type="button" data-csv-remove-blank>Boş satırları kaldır</button>
                        </div>

                        <div class="csv-scroll" tabindex="0" role="region" aria-label="CSV veri tablosu">
                            <table class="csv-table" data-csv-table>
                                <caption data-csv-summary>Henüz dosya yüklenmedi.</caption>
                                <thead data-csv-head></thead>
                                <tbody data-csv-body></tbody>
                            </table>
                        </div>

                        <p class="csv-note" data-csv-more></p>

                        <div class="tool-actions">
                            <button class="button button--primary" type="button" data-csv-export>CSV indir</button>
                            <button class="button" type="button" data-csv-export-json>JSON indir</button>
                            <button class="button button--quiet" type="button" data-csv-clear>Listeyi temizle</button>
                        </div>

                        <p class="tool-status" role="status" aria-live="polite" data-csv-status></p>

                        <noscript>
                            <p class="tool-noscript">CSV ayrıştırma JavaScript ile yapılır. JavaScript kapalıyken bu araç çalışmaz.</p>
                        </noscript>
                    </div>
                </div>
</div>
        </div>
    </div>
</section>
</main>
<script>
/*
 * Tarayıcı araçları için ortak yardımcılar.
 *
 * Bu dosya sunucuya istek göndermez; tüm yardımcılar dosyanın içinde
 * tanımlıdır ve başka bir dosyaya bağımlılık yoktur.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.common = factory();
}(typeof globalThis !== 'undefined' ? globalThis : this, function () {
    'use strict';

    function formatBytes(bytes) {
        var value = Number(bytes);

        if (!isFinite(value) || value < 0) {
            return '0 B';
        }

        if (value < 1024) {
            return Math.round(value) + ' B';
        }

        if (value < 1024 * 1024) {
            return (value / 1024).toFixed(1).replace('.', ',') + ' KB';
        }

        if (value < 1024 * 1024 * 1024) {
            return (value / (1024 * 1024)).toFixed(1).replace('.', ',') + ' MB';
        }

        return (value / (1024 * 1024 * 1024)).toFixed(2).replace('.', ',') + ' GB';
    }

    function safeFilename(name, fallback) {
        var value = typeof name === 'string' ? name : '';
        value = value.replace(/[\\/:*?"<>|\u0000-\u001f\u007f]/g, '-');
        value = value.replace(/\s+/g, ' ').trim();
        value = value.replace(/^\.+/, '');

        if (value === '') {
            value = typeof fallback === 'string' && fallback !== '' ? fallback : 'dosya';
        }

        if (value.length > 120) {
            value = value.slice(0, 120);
        }

        return value;
    }

    function debounce(callback, wait) {
        var timer = null;

        return function () {
            var args = arguments;
            var context = this;

            if (timer !== null) {
                clearTimeout(timer);
            }

            timer = setTimeout(function () {
                timer = null;
                callback.apply(context, args);
            }, wait);
        };
    }

    function setStatus(element, message, isError) {
        if (!element) {
            return;
        }

        element.textContent = message || '';
        element.classList.toggle('is-error', Boolean(isError));
    }

    function downloadBlob(blob, filename) {
        if (!blob || typeof document === 'undefined') {
            return false;
        }

        var url = URL.createObjectURL(blob);
        var link = document.createElement('a');

        link.href = url;
        link.download = safeFilename(filename, 'indirme');
        link.rel = 'noopener';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        setTimeout(function () {
            URL.revokeObjectURL(url);
        }, 30000);

        return true;
    }

    function downloadText(text, mime, filename) {
        return downloadBlob(new Blob([text], { type: mime + ';charset=utf-8' }), filename);
    }

    function copyText(text) {
        if (typeof navigator !== 'undefined' && navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
            return navigator.clipboard.writeText(text);
        }

        return new Promise(function (resolve, reject) {
            if (typeof document === 'undefined') {
                reject(new Error('Panoya kopyalama bu ortamda kullanılamıyor.'));
                return;
            }

            var area = document.createElement('textarea');
            area.value = text;
            area.setAttribute('readonly', 'readonly');
            area.className = 'visually-hidden';
            document.body.appendChild(area);
            area.select();

            try {
                var copied = document.execCommand('copy');
                document.body.removeChild(area);

                if (copied) {
                    resolve();
                } else {
                    reject(new Error('Panoya kopyalama tarayıcı tarafından engellendi.'));
                }
            } catch (error) {
                document.body.removeChild(area);
                reject(new Error('Panoya kopyalama bu tarayıcıda desteklenmiyor.'));
            }
        });
    }

    function extensionOf(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(dot + 1).toLowerCase() : '';
    }

    function baseName(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(0, dot) : value;
    }

    return {
        formatBytes: formatBytes,
        safeFilename: safeFilename,
        debounce: debounce,
        setStatus: setStatus,
        downloadBlob: downloadBlob,
        downloadText: downloadText,
        copyText: copyText,
        extensionOf: extensionOf,
        baseName: baseName
    };
}));

/*
 * CSV Toolkit — tarayıcıda CSV ayrıştırma, filtreleme ve dışa aktarma.
 *
 * Hücreler HTML olarak yorumlanmaz. CSV dışa aktarımında elektronik tablo
 * formülü enjeksiyonunu etkisizleştirme seçeneği varsayılan olarak açıktır.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.csvToolkit = factory(root.PortfolioTools.common);
}(typeof globalThis !== 'undefined' ? globalThis : this, function (common) {
    'use strict';

    var MAX_BYTES = 5 * 1024 * 1024;
    var MAX_ROWS = 20000;
    var MAX_COLUMNS = 120;
    var DISPLAY_ROWS = 300;
    var DELIMITERS = [
        { value: ',', label: 'Virgül (,)' },
        { value: ';', label: 'Noktalı virgül (;)' },
        { value: '\t', label: 'Sekme' },
        { value: '|', label: 'Dikey çizgi (|)' }
    ];

    function csvError(code, message) {
        var error = new Error(message);
        error.code = code;
        return error;
    }

    function stripBom(text) {
        var value = String(text);
        return value.charCodeAt(0) === 0xFEFF ? value.slice(1) : value;
    }

    function detectDelimiter(text) {
        var source = stripBom(text);
        var counts = { ',': 0, ';': 0, '\t': 0, '|': 0 };
        var inQuotes = false;
        var limit = Math.min(source.length, 200000);

        for (var index = 0; index < limit; index += 1) {
            var character = source.charAt(index);

            if (character === '"') {
                if (inQuotes && source.charAt(index + 1) === '"') {
                    index += 1;
                } else {
                    inQuotes = !inQuotes;
                }
            } else if (!inQuotes && Object.prototype.hasOwnProperty.call(counts, character)) {
                counts[character] += 1;
            }
        }

        var best = ',';
        var bestCount = -1;

        DELIMITERS.forEach(function (entry) {
            if (counts[entry.value] > bestCount) {
                best = entry.value;
                bestCount = counts[entry.value];
            }
        });

        return best;
    }

    function parseCsv(text, options) {
        var settings = options || {};
        var source = stripBom(text);
        var delimiter = settings.delimiter && settings.delimiter !== 'auto'
            ? settings.delimiter
            : detectDelimiter(source);
        var maxRows = settings.maxRows || MAX_ROWS;
        var maxColumns = settings.maxColumns || MAX_COLUMNS;

        if (source.length > (settings.maxChars || MAX_BYTES * 2)) {
            throw csvError('too_large', 'CSV metni çok büyük. En fazla 5 MB dosya işlenebilir.');
        }

        var rows = [];
        var row = [];
        var field = '';
        var inQuotes = false;
        var quotedField = false;
        var index = 0;

        while (index < source.length) {
            var character = source.charAt(index);

            if (inQuotes) {
                if (character === '"') {
                    if (source.charAt(index + 1) === '"') {
                        field += '"';
                        index += 2;
                        continue;
                    }

                    inQuotes = false;
                    index += 1;
                    continue;
                }

                field += character;
                index += 1;
                continue;
            }

            if (character === '"' && field === '') {
                inQuotes = true;
                quotedField = true;
                index += 1;
                continue;
            }

            if (character === delimiter) {
                row.push(field);
                field = '';
                quotedField = false;
                index += 1;
                continue;
            }

            if (character === '\r' || character === '\n') {
                row.push(field);
                field = '';
                quotedField = false;
                rows.push(row);
                row = [];

                if (rows.length > maxRows) {
                    throw csvError('too_many_rows', 'CSV dosyası çok fazla satır içeriyor. En fazla ' + maxRows + ' satır işlenebilir.');
                }

                if (character === '\r' && source.charAt(index + 1) === '\n') {
                    index += 2;
                } else {
                    index += 1;
                }

                continue;
            }

            field += character;
            index += 1;
        }

        if (inQuotes) {
            throw csvError('unclosed_quote', 'CSV içinde kapanmamış bir çift tırnak var. Tırnakları kontrol edin.');
        }

        if (field !== '' || row.length > 0 || quotedField) {
            row.push(field);
            rows.push(row);
        }

        if (rows.length > maxRows) {
            throw csvError('too_many_rows', 'CSV dosyası çok fazla satır içeriyor. En fazla ' + maxRows + ' satır işlenebilir.');
        }

        rows.forEach(function (current) {
            if (current.length > maxColumns) {
                throw csvError('too_many_columns', 'CSV dosyası çok fazla sütun içeriyor. En fazla ' + maxColumns + ' sütun işlenebilir.');
            }
        });

        return {
            rows: rows,
            delimiter: delimiter
        };
    }

    function isBlankRow(row) {
        return row.every(function (cell) {
            return String(cell).trim() === '';
        });
    }

    function removeBlankRows(rows) {
        return rows.filter(function (row) {
            return !isBlankRow(row);
        });
    }

    function rowKey(row) {
        return JSON.stringify(row);
    }

    /**
     * Satırlara görünüm sırasını taşıyan, serileştirmeye yansımayan bir damga ekler.
     * Yinelenen satırlar aynı içeriğe sahip olduğu için indexOf tek başına yetersizdir.
     */
    function tagRows(rows) {
        rows.forEach(function (row, index) {
            row.__csvIndex = index;
        });

        return rows;
    }

    function rowIndexOf(row, rows) {
        return typeof row.__csvIndex === 'number' ? row.__csvIndex : rows.indexOf(row);
    }

    function findDuplicateRows(rows) {
        var counts = Object.create(null);

        rows.forEach(function (row) {
            var key = rowKey(row);
            counts[key] = (counts[key] || 0) + 1;
        });

        var flags = rows.map(function (row) {
            return counts[rowKey(row)] > 1;
        });

        return {
            flags: flags,
            rows: flags.filter(Boolean).length,
            groups: Object.keys(counts).filter(function (key) {
                return counts[key] > 1;
            }).length
        };
    }

    function uniqueHeaderNames(header, width) {
        var used = Object.create(null);
        var names = [];

        for (var index = 0; index < width; index += 1) {
            var base = String(header[index] === undefined ? '' : header[index]).trim();

            if (base === '') {
                base = 'kolon_' + (index + 1);
            }

            var name = base;
            var suffix = 2;

            while (used[name]) {
                name = base + '_' + suffix;
                suffix += 1;
            }

            used[name] = true;
            names.push(name);
        }

        return names;
    }

    function rowsToObjects(headers, rows) {
        if (rows.length === 0) {
            return [];
        }

        var width = Math.max(headers.length, rows.reduce(function (max, row) {
            return Math.max(max, row.length);
        }, 0));
        var names = uniqueHeaderNames(headers, width);

        return rows.map(function (row) {
            var object = {};

            names.forEach(function (name, index) {
                object[name] = row[index] === undefined ? '' : row[index];
            });

            return object;
        });
    }

    function formulaRisk(value) {
        return /^[\s]*[=+\-@]/.test(String(value));
    }

    function csvEscape(value, delimiter, mitigateFormulas) {
        var text = value === null || value === undefined ? '' : String(value);

        if (mitigateFormulas && formulaRisk(text)) {
            text = "'" + text;
        }

        if (text.indexOf(delimiter) !== -1 || /["\r\n]/.test(text) || /^\s|\s$/.test(text)) {
            return '"' + text.replace(/"/g, '""') + '"';
        }

        return text;
    }

    function toCsv(rows, delimiter, mitigateFormulas) {
        var separator = delimiter || ',';

        return rows.map(function (row) {
            return row.map(function (cell) {
                return csvEscape(cell, separator, Boolean(mitigateFormulas));
            }).join(separator);
        }).join('\r\n') + (rows.length > 0 ? '\r\n' : '');
    }

    function toJson(headers, rows) {
        return JSON.stringify(rowsToObjects(headers, rows), null, 2);
    }

    function lower(value) {
        try {
            return String(value).toLocaleLowerCase('tr');
        } catch (error) {
            return String(value).toLowerCase();
        }
    }

    function filterRows(rows, query, columns) {
        var needle = lower(query).trim();

        if (needle === '') {
            return rows;
        }

        return rows.filter(function (row) {
            return columns.some(function (index) {
                return lower(row[index] || '').indexOf(needle) !== -1;
            });
        });
    }

    function sortRows(rows, columnIndex, direction, collator) {
        if (columnIndex === null || columnIndex === undefined || columnIndex < 0 || direction === 'none') {
            return rows.slice();
        }

        var compare;

        if (typeof collator === 'function') {
            compare = collator;
        } else if (collator && typeof collator.compare === 'function') {
            compare = function (left, right) {
                return collator.compare(String(left), String(right));
            };
        } else {
            compare = function (left, right) {
                return String(left).localeCompare(String(right), 'tr', { numeric: true, sensitivity: 'base' });
            };
        }

        return rows.map(function (row, index) {
            return { row: row, index: index };
        }).sort(function (left, right) {
            var result = compare(left.row[columnIndex] || '', right.row[columnIndex] || '');

            if (result === 0) {
                return left.index - right.index;
            }

            return direction === 'desc' ? -result : result;
        }).map(function (entry) {
            return entry.row;
        });
    }

    function init() {
        if (typeof document === 'undefined') {
            return;
        }

        var form = document.querySelector('[data-csv-form]');

        if (!form) {
            return;
        }

        var fileInput = document.getElementById('csv-file');
        var dropzone = document.querySelector('[data-csv-dropzone]');
        var status = document.querySelector('[data-csv-status]');
        var summary = document.querySelector('[data-csv-summary]');
        var empty = document.querySelector('[data-csv-empty]');
        var panel = document.querySelector('[data-csv-panel]');
        var table = document.querySelector('[data-csv-table]');
        var head = document.querySelector('[data-csv-head]');
        var body = document.querySelector('[data-csv-body]');
        var columnsBox = document.querySelector('[data-csv-columns]');
        var delimiterSelect = document.getElementById('csv-delimiter');
        var sortSelect = document.getElementById('csv-sort');
        var sortDirection = document.getElementById('csv-sort-direction');
        var searchInput = document.getElementById('csv-search');
        var duplicatesOnly = document.getElementById('csv-duplicates-only');
        var removeBlank = document.querySelector('[data-csv-remove-blank]');
        var exportCsv = document.querySelector('[data-csv-export]');
        var exportJson = document.querySelector('[data-csv-export-json]');
        var mitigate = document.getElementById('csv-mitigate');
        var clearButton = document.querySelector('[data-csv-clear]');
        var moreNote = document.querySelector('[data-csv-more]');

        if (!fileInput || !status || !summary || !empty || !panel || !table || !head || !body || !columnsBox) {
            return;
        }

        var rawText = '';
        var fileName = 'veri.csv';
        var headers = [];
        var dataRows = [];
        var selectedColumns = [];
        var duplicateFlags = [];
        var lastDelimiter = 'auto';
        var collator = null;

        try {
            collator = new Intl.Collator('tr', { numeric: true, sensitivity: 'base' });
        } catch (error) {
            collator = null;
        }

        function setStatus(message, isError) {
            status.textContent = message || '';
            status.classList.toggle('is-error', Boolean(isError));
        }

        function showEmpty(message) {
            empty.hidden = false;
            empty.textContent = message;
            panel.hidden = true;
        }

        function showPanel() {
            empty.hidden = true;
            panel.hidden = false;
        }

        function delimiterLabel(value) {
            for (var index = 0; index < DELIMITERS.length; index += 1) {
                if (DELIMITERS[index].value === value) {
                    return DELIMITERS[index].label;
                }
            }

            return 'Virgül (,)';
        }

        function resetTable(message) {
            rawText = '';
            fileName = 'veri.csv';
            headers = [];
            dataRows = [];
            selectedColumns = [];
            duplicateFlags = [];
            head.textContent = '';
            body.textContent = '';
            columnsBox.textContent = '';
            if (sortSelect) {
                sortSelect.textContent = '';
            }
            if (searchInput) {
                searchInput.value = '';
            }
            if (duplicatesOnly) {
                duplicatesOnly.checked = false;
            }
            if (moreNote) {
                moreNote.textContent = '';
            }
            summary.textContent = 'Henüz dosya yüklenmedi.';
            showEmpty(message || 'Görüntülemek için bir CSV dosyası seçin veya buraya bırakın.');
        }

        function buildColumnControls() {
            columnsBox.textContent = '';

            headers.forEach(function (header, index) {
                var label = document.createElement('label');
                var checkbox = document.createElement('input');
                var text = document.createElement('span');

                label.className = 'column-toggle';
                checkbox.type = 'checkbox';
                checkbox.checked = selectedColumns.indexOf(index) !== -1;
                checkbox.setAttribute('data-column-index', String(index));
                text.textContent = header;

                checkbox.addEventListener('change', function () {
                    if (checkbox.checked) {
                        if (selectedColumns.indexOf(index) === -1) {
                            selectedColumns.push(index);
                        }
                    } else {
                        selectedColumns = selectedColumns.filter(function (value) {
                            return value !== index;
                        });
                    }

                    selectedColumns.sort(function (left, right) {
                        return left - right;
                    });
                    renderTable();
                });

                label.appendChild(checkbox);
                label.appendChild(text);
                columnsBox.appendChild(label);
            });
        }

        function buildSortOptions() {
            if (!sortSelect) {
                return;
            }

            sortSelect.textContent = '';
            var none = document.createElement('option');
            none.value = '';
            none.textContent = 'Sıralama yok';
            sortSelect.appendChild(none);

            headers.forEach(function (header, index) {
                var option = document.createElement('option');
                option.value = String(index);
                option.textContent = header;
                sortSelect.appendChild(option);
            });
        }

        function currentRows() {
            var visible = filterRows(dataRows, searchInput ? searchInput.value : '', selectedColumns);

            if (duplicatesOnly && duplicatesOnly.checked) {
                visible = visible.filter(function (row) {
                    var originalIndex = rowIndexOf(row, dataRows);
                    return originalIndex !== -1 && duplicateFlags[originalIndex];
                });
            }

            var columnIndex = sortSelect && sortSelect.value !== '' ? parseInt(sortSelect.value, 10) : null;
            var direction = sortDirection ? sortDirection.value : 'none';

            return sortRows(visible, columnIndex, direction, collator);
        }

        function renderTable() {
            if (!panel) {
                return;
            }

            head.textContent = '';
            body.textContent = '';

            if (headers.length === 0) {
                return;
            }

            var headerRow = document.createElement('tr');
            var lineHeader = document.createElement('th');
            lineHeader.scope = 'col';
            lineHeader.className = 'csv-table__line';
            lineHeader.textContent = 'Satır';
            headerRow.appendChild(lineHeader);

            selectedColumns.forEach(function (index) {
                var cell = document.createElement('th');
                cell.scope = 'col';
                cell.textContent = headers[index] || 'kolon_' + (index + 1);
                headerRow.appendChild(cell);
            });

            head.appendChild(headerRow);

            var rows = currentRows();
            var shown = rows.slice(0, DISPLAY_ROWS);

            shown.forEach(function (row) {
                var originalIndex = rowIndexOf(row, dataRows);
                var tr = document.createElement('tr');
                var line = document.createElement('td');
                var duplicate = duplicateFlags[originalIndex];

                tr.className = 'csv-row' + (duplicate ? ' is-duplicate' : '');
                line.className = 'csv-table__line';
                line.textContent = String(originalIndex + 2);

                if (duplicate) {
                    var badge = document.createElement('span');
                    badge.className = 'csv-duplicate-badge';
                    badge.textContent = 'Yinelenen';
                    line.appendChild(document.createTextNode(' '));
                    line.appendChild(badge);
                }

                tr.appendChild(line);

                selectedColumns.forEach(function (index) {
                    var cell = document.createElement('td');
                    cell.textContent = row[index] === undefined ? '' : row[index];
                    tr.appendChild(cell);
                });

                body.appendChild(tr);
            });

            if (rows.length === 0) {
                var emptyRow = document.createElement('tr');
                var emptyCell = document.createElement('td');
                emptyCell.colSpan = selectedColumns.length + 1;
                emptyCell.className = 'csv-empty';
                emptyCell.textContent = 'Filtreyle eşleşen satır yok.';
                emptyRow.appendChild(emptyCell);
                body.appendChild(emptyRow);
            }

            if (moreNote) {
                moreNote.textContent = rows.length > DISPLAY_ROWS
                    ? 'İlk ' + DISPLAY_ROWS + ' satır gösteriliyor. Dışa aktarma ' + rows.length + ' eşleşen satırın tamamını kapsar.'
                    : '';
            }

            var duplicateCount = duplicateFlags.filter(Boolean).length;
            summary.textContent = dataRows.length + ' veri satırı, ' + headers.length + ' sütun · '
                + rows.length + ' satır görünümde · ' + duplicateCount + ' yinelenen satır işaretli.';
        }

        function parseCurrent() {
            if (rawText === '') {
                resetTable();
                return;
            }

            try {
                var parsed = parseCsv(rawText, { delimiter: lastDelimiter });
                var rows = parsed.rows;

                if (rows.length === 0) {
                    resetTable('CSV dosyasında veri bulunamadı.');
                    return;
                }

                headers = rows[0].map(function (value, index) {
                    return String(value).trim() === '' ? 'kolon_' + (index + 1) : String(value).trim();
                });
                dataRows = tagRows(rows.slice(1));
                selectedColumns = headers.map(function (value, index) {
                    return index;
                });
                duplicateFlags = findDuplicateRows(dataRows).flags;

                buildColumnControls();
                buildSortOptions();
                renderTable();
                showPanel();
                var duplicates = duplicateFlags.filter(Boolean).length;
                setStatus('CSV ayrıştırıldı. Ayraç: ' + delimiterLabel(parsed.delimiter) + '.'
                    + (duplicates > 0 ? ' ' + duplicates + ' yinelenen satır bulundu.' : ' Yinelenen satır yok.'));
            } catch (error) {
                resetTable('CSV okunamadı. Hata ayrıntısı aşağıda.');
                setStatus(error.message || 'CSV ayrıştırılamadı.', true);
            }
        }

        function loadFile(file) {
            if (!file) {
                return;
            }

            if (file.size > MAX_BYTES) {
                resetTable('Dosya çok büyük.');
                setStatus('Dosya en fazla 5 MB olabilir. Seçilen dosya: ' + Math.ceil(file.size / 1024) + ' KB.', true);
                return;
            }

            fileName = file.name || 'veri.csv';
            file.text().then(function (text) {
                rawText = text;
                lastDelimiter = 'auto';

                if (delimiterSelect) {
                    delimiterSelect.value = 'auto';
                }

                parseCurrent();
            }).catch(function () {
                resetTable('Dosya okunamadı.');
                setStatus('Dosya tarayıcıda okunamadı.', true);
            });
        }

        fileInput.addEventListener('change', function () {
            loadFile(fileInput.files && fileInput.files[0]);
            fileInput.value = '';
        });

        if (delimiterSelect) {
            delimiterSelect.addEventListener('change', function () {
                lastDelimiter = delimiterSelect.value;
                parseCurrent();
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                renderTable();
            });
        }

        if (sortSelect) {
            sortSelect.addEventListener('change', renderTable);
        }

        if (sortDirection) {
            sortDirection.addEventListener('change', renderTable);
        }

        if (duplicatesOnly) {
            duplicatesOnly.addEventListener('change', renderTable);
        }

        if (removeBlank) {
            removeBlank.addEventListener('click', function () {
                var before = dataRows.length;
                dataRows = tagRows(removeBlankRows(dataRows));
                duplicateFlags = findDuplicateRows(dataRows).flags;
                renderTable();
                setStatus((before - dataRows.length) + ' boş satır kaldırıldı.');
            });
        }

        function exportRows() {
            var rows = currentRows();
            var columns = selectedColumns.slice();

            return {
                rows: rows.map(function (row) {
                    return columns.map(function (index) {
                        return row[index] === undefined ? '' : row[index];
                    });
                }),
                headers: columns.map(function (index) {
                    return headers[index] || 'kolon_' + (index + 1);
                })
            };
        }

        if (exportCsv) {
            exportCsv.addEventListener('click', function () {
                if (dataRows.length === 0) {
                    setStatus('Dışa aktarılacak veri yok.', true);
                    return;
                }

                var exported = exportRows();
                var csv = toCsv([exported.headers].concat(exported.rows), ',', mitigate ? mitigate.checked : true);
                var name = common.safeFilename(fileName.replace(/\.csv$/i, '') + '-filtreli.csv', 'veri-filtreli.csv');

                common.downloadBlob(new Blob([csv], { type: 'text/csv;charset=utf-8' }), name);

                setStatus('CSV indirildi: ' + exported.rows.length + ' satır. Formül enjeksiyonu koruması '
                    + (mitigate && !mitigate.checked ? 'kapalı.' : 'açık.'));
            });
        }

        if (exportJson) {
            exportJson.addEventListener('click', function () {
                if (dataRows.length === 0) {
                    setStatus('Dışa aktarılacak veri yok.', true);
                    return;
                }

                var exported = exportRows();
                var json = toJson(exported.headers, exported.rows);
                var name = common.safeFilename(fileName.replace(/\.csv$/i, '') + '-filtreli.json', 'veri-filtreli.json');

                common.downloadBlob(new Blob([json], { type: 'application/json;charset=utf-8' }), name);

                setStatus('JSON indirildi: ' + exported.rows.length + ' kayıt.');
            });
        }

        if (clearButton) {
            clearButton.addEventListener('click', function () {
                resetTable();
                setStatus('Liste temizlendi.');
            });
        }

        if (dropzone) {
            ['dragenter', 'dragover'].forEach(function (name) {
                dropzone.addEventListener(name, function (event) {
                    event.preventDefault();
                    dropzone.classList.add('is-dragover');
                });
            });

            ['dragleave', 'drop'].forEach(function (name) {
                dropzone.addEventListener(name, function (event) {
                    event.preventDefault();
                    dropzone.classList.remove('is-dragover');
                });
            });

            dropzone.addEventListener('drop', function (event) {
                if (event.dataTransfer && event.dataTransfer.files) {
                    loadFile(event.dataTransfer.files[0]);
                }
            });
        }

        resetTable();
    }

    if (typeof document !== 'undefined') {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    }

    return {
        MAX_BYTES: MAX_BYTES,
        MAX_ROWS: MAX_ROWS,
        MAX_COLUMNS: MAX_COLUMNS,
        DISPLAY_ROWS: DISPLAY_ROWS,
        DELIMITERS: DELIMITERS,
        stripBom: stripBom,
        detectDelimiter: detectDelimiter,
        parseCsv: parseCsv,
        isBlankRow: isBlankRow,
        removeBlankRows: removeBlankRows,
        findDuplicateRows: findDuplicateRows,
        tagRows: tagRows,
        rowIndexOf: rowIndexOf,
        uniqueHeaderNames: uniqueHeaderNames,
        rowsToObjects: rowsToObjects,
        formulaRisk: formulaRisk,
        csvEscape: csvEscape,
        toCsv: toCsv,
        toJson: toJson,
        filterRows: filterRows,
        sortRows: sortRows
    };
}));

</script>
</body>
</html>
