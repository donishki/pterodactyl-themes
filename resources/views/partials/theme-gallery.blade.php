html:not([data-panel-theme]) .theme-gallery { --theme-surface: #fff; --theme-border: #d2d6de; --theme-muted: #64748b; --theme-accent: #367fa9; }
/* Themes gallery uses full interface previews, not colored placeholder blocks. */
.theme-gallery { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; margin: 8px 0 28px; }
.theme-tile { background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 12px; overflow: hidden; }
.theme-tile.is-active { border-color: var(--theme-accent); box-shadow: 0 0 0 1px var(--theme-accent); }
.theme-tile-info { padding: 16px; }
.theme-tile-info h3 { font-size: 14px; font-weight: 600; margin: 0 0 6px; }
.theme-tile-info p { font-size: 12px; color: var(--theme-muted); margin-bottom: 16px; min-height: 20px; }
.theme-tile-actions { display: flex; flex-wrap: wrap; gap: 6px; }
.theme-tile-actions form { display: inline; }
.theme-tile-actions .btn { padding: 6px 10px !important; }
.theme-mini { height: 150px; padding: 14px; position: relative; background: var(--mini-bg); color: var(--mini-text); border-bottom: 1px solid rgb(128 128 128 / .15); }
.theme-mini-top { display: flex; gap: 4px; align-items: center; margin-bottom: 18px; }
.theme-mini-top i { width: 5px; height: 5px; border-radius: 50%; background: var(--mini-muted); opacity: .5; }
.theme-mini-top span { margin-left: auto; width: 34px; height: 5px; background: var(--mini-muted); opacity: .4; border-radius: 2px; }
.theme-mini-body { display: grid; grid-template-columns: 22px 1fr; gap: 13px; }
.theme-mini-side i { display: block; width: 16px; height: 4px; margin-bottom: 10px; border-radius: 2px; background: var(--mini-muted); opacity: .4; }
.theme-mini-side i:first-child { background: var(--mini-accent); opacity: 1; }
.theme-mini-main strong { display: block; font-size: 9px; margin-bottom: 10px; }
.theme-mini-cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 5px; margin-bottom: 9px; }
.theme-mini-cards i { height: 24px; background: var(--mini-surface); border-radius: 4px; border-top: 2px solid var(--mini-accent); }
.theme-mini-row { height: 27px; border-radius: 4px; background: var(--mini-surface); display: flex; align-items: center; gap: 8px; padding: 7px; }
.theme-mini-row b { height: 5px; width: 5px; border-radius: 50%; background: #58c5a0; }
.theme-mini-row span { height: 4px; width: 60%; border-radius: 2px; background: var(--mini-muted); opacity: .5; }
.theme-active-label { color: var(--theme-accent); font-size: 10px; text-transform: uppercase; letter-spacing: .08em; margin-left: 8px; }
.theme-editor-preview { margin-top: 4px; border: 1px solid var(--theme-border); border-radius: 10px; padding: 24px; }

@media (max-width: 1200px) { .theme-gallery { grid-template-columns: repeat(2,minmax(0,1fr)); } }
@media (max-width: 460px) { .theme-gallery { grid-template-columns: 1fr; } }

.theme-active-label { background: transparent; padding: 0; }

.theme-library-controls { display: flex; gap: 18px; align-items: flex-end; margin: 24px 0; flex-wrap: wrap; }
.theme-library-controls > div:first-child { flex: 1; min-width: 180px; }
.theme-library-controls > div:nth-child(2) { width: 160px; }
.theme-library-controls label { display: block; font-size: 12px; }
#theme-results { padding-bottom: 9px; font-size: 12px; }
.theme-tile[hidden], #theme-no-results[hidden] { display: none !important; }
.theme-source { display: block; font-size: 11px; margin: -5px 0 14px; }
.theme-tile-info { display: flex; flex-direction: column; flex: 1; }
.theme-tile { display: flex; flex-direction: column; }
.theme-tile-actions { margin-top: auto; }
