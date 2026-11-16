/* All rules are emitted only for an active custom theme. Original stays untouched. */
body { background: var(--theme-background) !important; color: var(--theme-text) !important; font-family: var(--theme-font), sans-serif; }
body.skin-blue { font-size: 14px; line-height: 1.6; }
body :focus-visible { outline: 2px solid var(--theme-accent); outline-offset: 3px; }
::selection { background: var(--theme-accent-soft); color: var(--theme-text); }
.panel-theme-logo { max-height: 28px; max-width: 140px; object-fit: contain; vertical-align: middle; margin-right: 10px; }
/* Client shell and shared surfaces. */
.theme-client-nav { border-bottom: 1px solid var(--theme-border); background: var(--theme-surface); box-shadow: none !important; }
.theme-client-nav > div:last-child { height: 72px; }
.theme-client-nav #logo a { font-size: 18px; letter-spacing: -.4px; }
.theme-subnav { background: var(--theme-background); box-shadow: none; border-bottom: 1px solid var(--theme-border); }
.theme-subnav > div > a, .theme-subnav > div > div { padding-top: 17px; padding-bottom: 17px; font-weight: 500; }
.theme-subnav .active { color: var(--theme-text); }
.theme-row { border-color: var(--theme-border); border-radius: var(--theme-radius); background: var(--theme-surface); }
.theme-row:hover { background: var(--theme-raised); }
.theme-row .icon { background: var(--theme-accent-soft); color: var(--theme-accent); border-radius: 12px; width: 48px; height: 48px; flex-shrink: 0; }
.theme-server-row { padding: 24px; margin-bottom: 14px; box-shadow: 0 6px 20px rgb(0 0 0 / .06); }
.theme-server-row .status-bar { width: 3px; height: 32px; right: 0; top: calc(50% - 16px); margin: 0; opacity: 1; border-radius: 3px 0 0 3px; }
.theme-card { border: 1px solid var(--theme-border); overflow: hidden; box-shadow: 0 4px 18px rgb(0 0 0 / .05); }
.theme-card > div:first-child { background: var(--theme-surface); border-bottom: 1px solid var(--theme-border); padding: 18px 22px; }
.theme-card > div:first-child p { font-size: 14px; font-weight: 600; text-transform: none; }
.theme-card > div:last-child { padding: 22px; }
.theme-dashboard-heading { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin: 8px 0 32px; }
.theme-eyebrow { display: block; font-size: 11px; text-transform: uppercase; letter-spacing: .16em; color: var(--theme-accent); font-weight: 650; margin-bottom: 8px; }
.theme-dashboard-heading h1 { font-size: 30px; font-weight: 600; letter-spacing: -.8px; line-height: 1.3; margin-bottom: 8px; }
.theme-dashboard-heading p { color: var(--theme-muted); font-size: 14px; }
.theme-heading-badge { border: 1px solid var(--theme-border); border-radius: 30px; color: var(--theme-muted); padding: 8px 14px; font-size: 12px; white-space: nowrap; }
.theme-auth-card, .theme-dropdown { background: var(--theme-surface) !important; color: var(--theme-text); border: 1px solid var(--theme-border); }
.theme-auth-card { padding: 32px !important; box-shadow: 0 24px 80px rgb(0 0 0 / .15); }
.theme-auth h2 { font-size: 26px; letter-spacing: -.6px; margin-bottom: 18px; }
.theme-auth input:not([type=checkbox]) { background: var(--theme-input); color: var(--theme-text); border-color: var(--theme-border); }
.theme-dropdown { box-shadow: 0 12px 40px rgb(0 0 0 / .25); }
/* Keep console and code fonts/contrast independent of decorative palette changes. */
.xterm, .xterm *, .CodeMirror, .CodeMirror * { font-family: ui-monospace, SFMono-Regular, Consolas, monospace; }
/* Admin shell. Keep AdminLTE dimensions and responsive collapse behavior intact. */
body.skin-blue .wrapper, body.skin-blue .content-wrapper, body.skin-blue .main-footer { background: var(--theme-background); color: var(--theme-text); }
body.skin-blue .main-sidebar, body.skin-blue .main-header .navbar, body.skin-blue .main-header .logo { background: var(--theme-surface); color: var(--theme-text); }
body.skin-blue .main-header { border-bottom: 1px solid var(--theme-border); }
body.skin-blue .main-header .logo { font: 600 16px/50px var(--theme-font), sans-serif; letter-spacing: -.4px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 0 18px; }
body.skin-blue .main-header .navbar .sidebar-toggle:hover, body.skin-blue .navbar-custom-menu .nav>li>a:hover { background: var(--theme-raised); }
body.skin-blue .main-sidebar { border-right: 1px solid var(--theme-border); }
body.skin-blue .sidebar-menu>li.header { background: transparent; color: var(--theme-muted); font-size: 10px; font-weight: 600; letter-spacing: .12em; padding: 24px 22px 9px; }
body.skin-blue .sidebar-menu>li>a { color: var(--theme-muted); margin: 3px 12px; border: 0; border-radius: 8px; padding: 11px 13px; font-weight: 500; }
body.skin-blue .sidebar-menu>li>a>.fa { margin-right: 7px; }
body.skin-blue .sidebar-menu>li.active>a { background: var(--theme-accent-soft); color: var(--theme-accent); }
body.skin-blue .sidebar-menu>li>a:hover { background: var(--theme-raised); color: var(--theme-text); }
body.skin-blue .content-header { padding: 28px 30px 10px; }
body.skin-blue .content-header h1 { font-size: 27px; letter-spacing: -.7px; font-weight: 600; }
body.skin-blue .content-header h1 small { display: inline-block; color: var(--theme-muted); font-size: 13px; font-weight: 400; letter-spacing: 0; }
body.skin-blue .content { padding: 20px 30px 30px; }
body.skin-blue .breadcrumb, body.skin-blue .breadcrumb>.active, body.skin-blue .breadcrumb li a { color: var(--theme-muted); background: transparent; }
body.skin-blue .main-footer { border-top: 1px solid var(--theme-border); color: var(--theme-muted); padding: 20px 30px; font-size: 12px; }
body.skin-blue .box, body.skin-blue .nav-tabs-custom, body.skin-blue .modal-content { background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: var(--theme-radius); box-shadow: 0 5px 24px rgb(0 0 0 / .06); color: var(--theme-text); }
body.skin-blue .box-header, body.skin-blue .modal-header { padding: 18px 20px; color: var(--theme-text); border-bottom: 1px solid var(--theme-border); }
body.skin-blue .box-title { font-size: 15px; font-weight: 600; }
body.skin-blue .box-body, body.skin-blue .modal-body { padding: 20px; }
body.skin-blue .box-footer, body.skin-blue .modal-footer { background: transparent; border-top: 1px solid var(--theme-border); padding: 16px 20px; border-radius: 0 0 var(--theme-radius) var(--theme-radius); }
body.skin-blue .box .no-padding { padding: 0; }
body.skin-blue .box-tools .btn { color: var(--theme-muted); }
body.skin-blue .form-group { margin-bottom: 20px; }
body.skin-blue label { font-size: 12px; font-weight: 600; color: var(--theme-text); margin-bottom: 7px; }
body.skin-blue .form-control, body.skin-blue .input-group-addon { background: var(--theme-input); border: 1px solid var(--theme-border); color: var(--theme-text); border-radius: 7px; box-shadow: none; }
body.skin-blue input.form-control, body.skin-blue select.form-control { height: 38px; }
body.skin-blue .form-control:focus { border-color: var(--theme-accent); box-shadow: 0 0 0 3px var(--theme-accent-soft); }
body.skin-blue .form-control[disabled], body.skin-blue .form-control[readonly] { background: var(--theme-raised); color: var(--theme-muted); opacity: .8; }
body.skin-blue .form-control::placeholder { color: var(--theme-muted); opacity: .8; }
body.skin-blue .text-muted, body.skin-blue .help-block, body.skin-blue .text-gray { color: var(--theme-muted) !important; }
body.skin-blue .help-block { font-size: 12px; line-height: 1.6; }
body.skin-blue .btn { border-radius: 7px; padding: 8px 14px; font-weight: 600; font-size: 12px; box-shadow: none; transition: background .15s, border-color .15s; }
body.skin-blue .btn-xs { padding: 3px 7px; font-size: 11px; }
body.skin-blue .btn-primary { background: var(--theme-button); border-color: var(--theme-button); color: #fff; }
body.skin-blue .btn-primary:hover, body.skin-blue .btn-primary:focus, body.skin-blue .btn-primary.active { background: var(--theme-button-hover); border-color: var(--theme-button-hover); color: #fff; }
body.skin-blue .btn-default { background: var(--theme-raised); border-color: var(--theme-border); color: var(--theme-text); }
body.skin-blue .btn-default:hover, body.skin-blue .btn-default.active { background: var(--theme-accent-soft); border-color: var(--theme-accent); }
body.skin-blue a:not(.btn) { color: var(--theme-accent); }
body.skin-blue .sidebar a, body.skin-blue .navbar a, body.skin-blue .logo { color: var(--theme-text); }
body.skin-blue .table { color: var(--theme-text); margin-bottom: 0; }
body.skin-blue .table>thead>tr>th { font-size: 11px; letter-spacing: .04em; color: var(--theme-muted); font-weight: 600; background: var(--theme-input); padding: 13px 16px; }
body.skin-blue .table td, body.skin-blue .table th { border-color: var(--theme-border) !important; vertical-align: middle; }
body.skin-blue .table>tbody>tr>td { padding: 13px 16px; }
body.skin-blue .table-striped>tbody>tr:nth-of-type(odd) { background: var(--theme-surface); }
body.skin-blue .table-striped>tbody>tr:nth-of-type(even), body.skin-blue .table-hover>tbody>tr:hover { background: var(--theme-raised); }
body.skin-blue .table .danger, body.skin-blue .table .danger>td { background: #49262d; color: #ffe2e7; }
body.skin-blue .table .warning, body.skin-blue .table .warning>td { background: #453821; color: #fff0ca; }
body.skin-blue .table-responsive { border-color: var(--theme-border); }
body.skin-blue .nav-tabs, body.skin-blue .nav-tabs-custom>.nav-tabs { border-bottom: 1px solid var(--theme-border); }
body.skin-blue .nav-tabs>li>a { color: var(--theme-muted); border-radius: 7px 7px 0 0; }
body.skin-blue .nav-tabs>li>a:hover { background: var(--theme-raised); border-color: transparent; }
body.skin-blue .nav-tabs>li.active>a, body.skin-blue .nav-tabs>li.active>a:focus, body.skin-blue .nav-tabs>li.active>a:hover { background: var(--theme-surface); color: var(--theme-text); border-color: var(--theme-border); border-bottom-color: var(--theme-surface); }
body.skin-blue .nav-tabs-custom>.tab-content { background: var(--theme-surface); color: var(--theme-text); }
body.skin-blue .dropdown-menu { background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 8px; box-shadow: 0 16px 32px rgb(0 0 0 / .2); }
body.skin-blue .dropdown-menu>li>a { color: var(--theme-text); }
body.skin-blue .dropdown-menu>li>a:hover { background: var(--theme-raised); }
body.skin-blue .pagination>li>a, body.skin-blue .pagination>li>span { background: var(--theme-surface); border-color: var(--theme-border); color: var(--theme-muted); }
body.skin-blue .pagination>.active>a { background: var(--theme-button); color: #fff; }
body.skin-blue .well, body.skin-blue pre, body.skin-blue .list-group-item, body.skin-blue .info-box, body.skin-blue .progress { background: var(--theme-input); color: var(--theme-text); border-color: var(--theme-border); }
body.skin-blue code { background: var(--theme-input); color: var(--theme-accent); border-radius: 4px; }
body.skin-blue .list-group-item { border-color: var(--theme-border); }
body.skin-blue hr { border-color: var(--theme-border); }
body.skin-blue .close { color: var(--theme-text); opacity: .7; text-shadow: none; }
body.skin-blue .select2-container--default .select2-selection, body.skin-blue .select2-dropdown, body.skin-blue .select2-search__field { background: var(--theme-input); color: var(--theme-text); border-color: var(--theme-border); border-radius: 7px; }
body.skin-blue .select2-container--default .select2-selection--single { height: 38px; }
body.skin-blue .select2-container--default .select2-selection__rendered { color: var(--theme-text); }
body.skin-blue .select2-container--default .select2-selection__choice { background: var(--theme-raised); border-color: var(--theme-border); color: var(--theme-text); }
body.skin-blue .select2-results__option[aria-selected=true] { background: var(--theme-raised); }
body.skin-blue .select2-container--default .select2-results__option--highlighted[aria-selected] { background: var(--theme-button); color: #fff; }
body.skin-blue .sweet-alert { background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 14px; }
body.skin-blue .sweet-alert h2, body.skin-blue .sweet-alert p { color: var(--theme-text); }
body.skin-blue .sweet-alert input { background: var(--theme-input); color: var(--theme-text); border-color: var(--theme-border); }
@media (min-width: 768px) { body.skin-blue.sidebar-collapse .sidebar-menu>li>a { margin: 3px 4px; padding: 12px 10px; } }
@media (max-width: 1200px) { .theme-gallery { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 767px) {
    body.skin-blue .content-header { padding: 20px 16px 4px; }
    body.skin-blue .content { padding: 16px; }
    body.skin-blue .content-header h1 small { display: block; margin-top: 8px; }
    .theme-client-nav > div:last-child { height: 60px; }
    .theme-client-nav #logo a { font-size: 14px; }
    .theme-client-nav #logo { min-width: 130px; }
    .theme-dashboard-heading { margin-bottom: 24px; }
    .theme-dashboard-heading h1 { font-size: 25px; }
    .theme-heading-badge { display: none; }
    .theme-server-row { padding: 18px; }
    .theme-card > div:last-child { padding: 18px; }
    .theme-auth-card { padding: 24px !important; }
}
@media (max-width: 460px) { .theme-gallery { grid-template-columns: 1fr; } }

html[data-panel-theme] .theme-button { text-transform: none; letter-spacing: 0; font-weight: 600; border-radius: 8px; }
html[data-panel-theme] .theme-stat { background: var(--theme-surface); border: 1px solid var(--theme-border); box-shadow: none; }
html[data-panel-theme] .theme-modal { background: var(--theme-surface); border: 1px solid var(--theme-border); box-shadow: 0 24px 80px rgb(0 0 0 / .25); }
html[data-panel-theme] body:not(.skin-blue) input:not([type=checkbox]):not([type=radio]), html[data-panel-theme] body:not(.skin-blue) select, html[data-panel-theme] body:not(.skin-blue) textarea { border-width: 1px; }

html[data-panel-theme] .theme-empty { background: var(--theme-surface); border: 1px solid var(--theme-border); }
html[data-panel-theme] input:disabled, html[data-panel-theme] textarea:disabled, html[data-panel-theme] select:disabled { background: var(--theme-raised); color: var(--theme-muted); }

html[data-panel-theme] .theme-row { border-color: var(--theme-border); background: var(--theme-surface); }
html[data-panel-theme] .theme-server-row { padding: 24px; }
@media (max-width: 767px) { html[data-panel-theme] .theme-server-row { padding: 18px; } }

/* Keep all account actions reachable on narrow screens without horizontal scrolling. */
@media (max-width: 600px) {
    html[data-panel-theme] .theme-client-nav { overflow-x: visible; }
    html[data-panel-theme] .theme-client-nav > div:last-child { height: auto; flex-wrap: wrap; }
    html[data-panel-theme] .theme-client-nav #logo { flex: 0 0 100%; padding: 13px 0 8px; min-width: 0; }
    html[data-panel-theme] .theme-client-nav #logo a { display: block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; font-size: 15px; }
    html[data-panel-theme] .theme-client-nav #logo + div { width: 100%; height: 44px; justify-content: space-around; }
    html[data-panel-theme] .theme-client-nav #logo + div > a,
    html[data-panel-theme] .theme-client-nav #logo + div > button,
    html[data-panel-theme] .theme-client-nav #logo + div > .navigation-link { padding: 0 20px; }
}
html[data-panel-theme] .theme-row:hover { background: var(--theme-raised); }
body.skin-blue .box-header, body.skin-blue .modal-header { background: var(--theme-surface); }
body.skin-blue .theme-active-label { background: var(--theme-accent-soft) !important; color: var(--theme-accent); border-radius: 4px; padding: 3px 5px; }
