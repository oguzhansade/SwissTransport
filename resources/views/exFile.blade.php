
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeMarch">
  <!-- Site Title -->
  <title>Student Billing Invoice</title>
  <style>
        /*--------------------------------------------------------------
    >> TABLE OF CONTENTS:
    ----------------------------------------------------------------
    1. Normalize
    2. Typography
    3. Invoice General Style
    --------------------------------------------------------------*/
    /*--------------------------------------------------------------
    2. Normalize
    ----------------------------------------------------------------*/
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap");
    *,
    ::after,
    ::before {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    }

    html {
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    }

    /* Sections
    ========================================================================== */
    /**
    * Remove the margin in all browsers.
    */
    body {
    margin: 0;
    }

    /**
    * Render the `main` element consistently in IE.
    */
    main {
    display: block;
    }

    /**
    * Correct the font size and margin on `h1` elements within `section` and
    * `article` contexts in Chrome, Firefox, and Safari.
    */
    h1 {
    font-size: 2em;
    margin: 0.67em 0;
    }

    /* Grouping content
    ========================================================================== */
    /**
    * 1. Add the correct box sizing in Firefox.
    * 2. Show the overflow in Edge and IE.
    */
    hr {
    -webkit-box-sizing: content-box;
            box-sizing: content-box;
    /* 1 */
    height: 0;
    /* 1 */
    overflow: visible;
    /* 2 */
    }

    /**
    * 1. Correct the inheritance and scaling of font size in all browsers.
    * 2. Correct the odd `em` font sizing in all browsers.
    */
    pre {
    font-family: monospace, monospace;
    /* 1 */
    font-size: 1em;
    /* 2 */
    }

    /* Text-level semantics
    ========================================================================== */
    /**
    * Remove the gray background on active links in IE 10.
    */
    a {
    background-color: transparent;
    }

    /**
    * 1. Remove the bottom border in Chrome 57-
    * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
    */
    abbr[title] {
    border-bottom: none;
    /* 1 */
    text-decoration: underline;
    /* 2 */
    -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
    /* 2 */
    }

    /**
    * Add the correct font weight in Chrome, Edge, and Safari.
    */
    b,
    strong {
    font-weight: bolder;
    }

    /**
    * 1. Correct the inheritance and scaling of font size in all browsers.
    * 2. Correct the odd `em` font sizing in all browsers.
    */
    code,
    kbd,
    samp {
    font-family: monospace, monospace;
    /* 1 */
    font-size: 1em;
    /* 2 */
    }

    /**
    * Add the correct font size in all browsers.
    */
    small {
    font-size: 80%;
    }

    /**
    * Prevent `sub` and `sup` elements from affecting the line height in
    * all browsers.
    */
    sub,
    sup {
    font-size: 75%;
    line-height: 0;
    position: relative;
    vertical-align: baseline;
    }

    sub {
    bottom: -0.25em;
    }

    sup {
    top: -0.5em;
    }

    /* Embedded content
    ========================================================================== */
    /**
    * Remove the border on images inside links in IE 10.
    */
    img {
    border-style: none;
    }

    /* Forms
    ========================================================================== */
    /**
    * 1. Change the font styles in all browsers.
    * 2. Remove the margin in Firefox and Safari.
    */
    button,
    input,
    optgroup,
    select,
    textarea {
    font-family: inherit;
    /* 1 */
    font-size: 100%;
    /* 1 */
    line-height: 1.15;
    /* 1 */
    margin: 0;
    /* 2 */
    }

    /**
    * Show the overflow in IE.
    * 1. Show the overflow in Edge.
    */
    button,
    input {
    /* 1 */
    overflow: visible;
    }

    /**
    * Remove the inheritance of text transform in Edge, Firefox, and IE.
    * 1. Remove the inheritance of text transform in Firefox.
    */
    button,
    select {
    /* 1 */
    text-transform: none;
    }

    /**
    * Correct the inability to style clickable types in iOS and Safari.
    */
    button,
    [type='button'],
    [type='reset'],
    [type='submit'] {
    -webkit-appearance: button;
    }

    /**
    * Remove the inner border and padding in Firefox.
    */
    button::-moz-focus-inner,
    [type='button']::-moz-focus-inner,
    [type='reset']::-moz-focus-inner,
    [type='submit']::-moz-focus-inner {
    border-style: none;
    padding: 0;
    }

    /**
    * Restore the focus styles unset by the previous rule.
    */
    button:-moz-focusring,
    [type='button']:-moz-focusring,
    [type='reset']:-moz-focusring,
    [type='submit']:-moz-focusring {
    outline: 1px dotted ButtonText;
    }

    /**
    * Correct the padding in Firefox.
    */
    fieldset {
    padding: 0.35em 0.75em 0.625em;
    }

    /**
    * 1. Correct the text wrapping in Edge and IE.
    * 2. Correct the color inheritance from `fieldset` elements in IE.
    * 3. Remove the padding so developers are not caught out when they zero out
    *    `fieldset` elements in all browsers.
    */
    legend {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    /* 1 */
    color: inherit;
    /* 2 */
    display: table;
    /* 1 */
    max-width: 100%;
    /* 1 */
    padding: 0;
    /* 3 */
    white-space: normal;
    /* 1 */
    }

    /**
    * Add the correct vertical alignment in Chrome, Firefox, and Opera.
    */
    progress {
    vertical-align: baseline;
    }

    /**
    * Remove the default vertical scrollbar in IE 10+.
    */
    textarea {
    overflow: auto;
    }

    /**
    * 1. Add the correct box sizing in IE 10.
    * 2. Remove the padding in IE 10.
    */
    [type='checkbox'],
    [type='radio'] {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    /* 1 */
    padding: 0;
    /* 2 */
    }

    /**
    * Correct the cursor style of increment and decrement buttons in Chrome.
    */
    [type='number']::-webkit-inner-spin-button,
    [type='number']::-webkit-outer-spin-button {
    height: auto;
    }

    /**
    * 1. Correct the odd appearance in Chrome and Safari.
    * 2. Correct the outline style in Safari.
    */
    [type='search'] {
    -webkit-appearance: textfield;
    /* 1 */
    outline-offset: -2px;
    /* 2 */
    }

    /**
    * Remove the inner padding in Chrome and Safari on macOS.
    */
    [type='search']::-webkit-search-decoration {
    -webkit-appearance: none;
    }

    /**
    * 1. Correct the inability to style clickable types in iOS and Safari.
    * 2. Change font properties to `inherit` in Safari.
    */
    ::-webkit-file-upload-button {
    -webkit-appearance: button;
    /* 1 */
    font: inherit;
    /* 2 */
    }

    /* Interactive
    ========================================================================== */
    /*
    * Add the correct display in Edge, IE 10+, and Firefox.
    */
    details {
    display: block;
    }

    /*
    * Add the correct display in all browsers.
    */
    summary {
    display: list-item;
    }

    /* Misc
    ========================================================================== */
    /**
    * Add the correct display in IE 10+.
    */
    template {
    display: none;
    }

    /**
    * Add the correct display in IE 10.
    */
    [hidden] {
    display: none;
    }

    /*--------------------------------------------------------------
    2. Typography
    ----------------------------------------------------------------*/
    body,
    html {
    color: #777777;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5em;
    overflow-x: hidden;
    background-color: #f5f7ff;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
    clear: both;
    color: #111111;
    padding: 0;
    margin: 0 0 20px 0;
    font-weight: 500;
    line-height: 1.2em;
    }

    h1 {
    font-size: 60px;
    }

    h2 {
    font-size: 48px;
    }

    h3 {
    font-size: 30px;
    }

    h4 {
    font-size: 24px;
    }

    h5 {
    font-size: 18px;
    }

    h6 {
    font-size: 16px;
    }

    p,
    div {
    margin-top: 0;
    line-height: 1.5em;
    }

    p {
    margin-bottom: 15px;
    }

    ul {
    margin: 0 0 25px 0;
    padding-left: 20px;
    list-style: square outside none;
    }

    ol {
    padding-left: 20px;
    margin-bottom: 25px;
    }

    dfn,
    cite,
    em,
    i {
    font-style: italic;
    }

    blockquote {
    margin: 0 15px;
    font-style: italic;
    font-size: 20px;
    line-height: 1.6em;
    margin: 0;
    }

    address {
    margin: 0 0 15px;
    }

    img {
    border: 0;
    max-width: 100%;
    height: auto;
    vertical-align: middle;
    }

    a {
    color: inherit;
    text-decoration: none;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    }

    a:hover {
    color: #2ad19d;
    }

    button {
    color: inherit;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    }

    a:hover {
    text-decoration: none;
    color: inherit;
    }

    table {
    width: 100%;
    caption-side: bottom;
    border-collapse: collapse;
    }

    th {
    text-align: left;
    }

    td {
    border-top: 1px solid #eaeaea;
    }

    td,
    th {
    padding: 10px 15px;
    line-height: 1.55em;
    }

    dl {
    margin-bottom: 25px;
    }

    dl dt {
    font-weight: 600;
    }

    b,
    strong {
    font-weight: bold;
    }

    pre {
    color: #777777;
    border: 1px solid #eaeaea;
    font-size: 18px;
    padding: 25px;
    border-radius: 5px;
    }

    kbd {
    font-size: 100%;
    background-color: #777777;
    border-radius: 5px;
    }

    /*--------------------------------------------------------------
    3. Invoice General Style
    ----------------------------------------------------------------*/
    .cs-f10 {
    font-size: 10px;
    }

    .cs-f11 {
    font-size: 11px;
    }

    .cs-f12 {
    font-size: 12px;
    }

    .cs-f13 {
    font-size: 13px;
    }

    .cs-f14 {
    font-size: 14px;
    }

    .cs-f15 {
    font-size: 15px;
    }

    .cs-f16 {
    font-size: 16px;
    }

    .cs-f17 {
    font-size: 17px;
    }

    .cs-f18 {
    font-size: 18px;
    }

    .cs-f19 {
    font-size: 19px;
    }

    .cs-f20 {
    font-size: 20px;
    }

    .cs-f21 {
    font-size: 21px;
    }

    .cs-f22 {
    font-size: 22px;
    }

    .cs-f23 {
    font-size: 23px;
    }

    .cs-f24 {
    font-size: 24px;
    }

    .cs-f25 {
    font-size: 25px;
    }

    .cs-f26 {
    font-size: 26px;
    }

    .cs-f27 {
    font-size: 27px;
    }

    .cs-f28 {
    font-size: 28px;
    }

    .cs-f29 {
    font-size: 29px;
    }

    .cs-light {
    font-weight: 300;
    }

    .cs-normal {
    font-weight: 400;
    }

    .cs-medium {
    font-weight: 500;
    }

    .cs-semi_bold {
    font-weight: 600;
    }

    .cs-bold {
    font-weight: 700;
    }

    .cs-m0 {
    margin: 0px;
    }

    .cs-mb0 {
    margin-bottom: 0px;
    }

    .cs-mb1 {
    margin-bottom: 1px;
    }

    .cs-mb2 {
    margin-bottom: 2px;
    }

    .cs-mb3 {
    margin-bottom: 3px;
    }

    .cs-mb4 {
    margin-bottom: 4px;
    }

    .cs-mb5 {
    margin-bottom: 5px;
    }

    .cs-mb6 {
    margin-bottom: 6px;
    }

    .cs-mb7 {
    margin-bottom: 7px;
    }

    .cs-mb8 {
    margin-bottom: 8px;
    }

    .cs-mb9 {
    margin-bottom: 9px;
    }

    .cs-mb10 {
    margin-bottom: 10px;
    }

    .cs-mb11 {
    margin-bottom: 11px;
    }

    .cs-mb12 {
    margin-bottom: 12px;
    }

    .cs-mb13 {
    margin-bottom: 13px;
    }

    .cs-mb14 {
    margin-bottom: 14px;
    }

    .cs-mb15 {
    margin-bottom: 15px;
    }

    .cs-mb16 {
    margin-bottom: 16px;
    }

    .cs-mb17 {
    margin-bottom: 17px;
    }

    .cs-mb18 {
    margin-bottom: 18px;
    }

    .cs-mb19 {
    margin-bottom: 19px;
    }

    .cs-mb20 {
    margin-bottom: 20px;
    }

    .cs-mb21 {
    margin-bottom: 21px;
    }

    .cs-mb22 {
    margin-bottom: 22px;
    }

    .cs-mb23 {
    margin-bottom: 23px;
    }

    .cs-mb24 {
    margin-bottom: 24px;
    }

    .cs-mb25 {
    margin-bottom: 25px;
    }

    .cs-mb26 {
    margin-bottom: 26px;
    }

    .cs-mb27 {
    margin-bottom: 27px;
    }

    .cs-mb28 {
    margin-bottom: 28px;
    }

    .cs-mb29 {
    margin-bottom: 29px;
    }

    .cs-mb30 {
    margin-bottom: 30px;
    }

    .cs-pt25 {
    padding-top: 25px;
    }

    .cs-width_1 {
    width: 8.33333333%;
    }

    .cs-width_2 {
    width: 16.66666667%;
    }

    .cs-width_3 {
    width: 25%;
    }

    .cs-width_4 {
    width: 33.33333333%;
    }

    .cs-width_5 {
    width: 41.66666667%;
    }

    .cs-width_6 {
    width: 50%;
    }

    .cs-width_7 {
    width: 58.33333333%;
    }

    .cs-width_8 {
    width: 66.66666667%;
    }

    .cs-width_9 {
    width: 75%;
    }

    .cs-width_10 {
    width: 83.33333333%;
    }

    .cs-width_11 {
    width: 91.66666667%;
    }

    .cs-width_12 {
    width: 100%;
    }

    .cs-accent_color,
    .cs-accent_color_hover:hover {
    color: #2ad19d;
    }

    .cs-accent_bg,
    .cs-accent_bg_hover:hover {
    background-color: #2ad19d;
    }

    .cs-primary_color {
    color: #111111;
    }

    .cs-secondary_color {
    color: #777777;
    }

    .cs-ternary_color {
    color: #353535;
    }

    .cs-ternary_color {
    border-color: #eaeaea;
    }

    .cs-focus_bg {
    background: #f6f6f6;
    }

    .cs-accent_10_bg {
    background-color: rgba(42, 209, 157, 0.1);
    }

    .cs-container {
    max-width: 880px;
    padding: 30px 15px;
    margin-left: auto;
    margin-right: auto;
    }

    .cs-text_center {
    text-align: center;
    }

    .cs-text_right {
    text-align: right;
    }

    .cs-border_bottom_0 {
    border-bottom: 0;
    }

    .cs-border_top_0 {
    border-top: 0;
    }

    .cs-border_bottom {
    border-bottom: 1px solid #eaeaea;
    }

    .cs-border_top {
    border-top: 1px solid #eaeaea;
    }

    .cs-border_left {
    border-left: 1px solid #eaeaea;
    }

    .cs-border_right {
    border-right: 1px solid #eaeaea;
    }

    .cs-table_baseline {
    vertical-align: baseline;
    }

    .cs-round_border {
    border: 1px solid #eaeaea;
    overflow: hidden;
    border-radius: 6px;
    }

    .cs-border_none {
    border: none;
    }

    .cs-border_left_none {
    border-left-width: 0;
    }

    .cs-border_right_none {
    border-right-width: 0;
    }

    .cs-invoice.cs-style1 {
    background: #fff;
    border-radius: 10px;
    padding: 50px;
    }

    .cs-invoice.cs-style1 .cs-invoice_head {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    }

    .cs-invoice.cs-style1 .cs-invoice_head.cs-type1 {
    -webkit-box-align: end;
        -ms-flex-align: end;
            align-items: flex-end;
    padding-bottom: 25px;
    border-bottom: 1px solid #eaeaea;
    }

    .cs-invoice.cs-style1 .cs-invoice_footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    }

    .cs-invoice.cs-style1 .cs-invoice_footer table {
    margin-top: -1px;
    }

    .cs-invoice.cs-style1 .cs-left_footer {
    width: 55%;
    padding: 10px 15px;
    }

    .cs-invoice.cs-style1 .cs-right_footer {
    width: 46%;
    }

    .cs-invoice.cs-style1 .cs-note {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
        -ms-flex-align: start;
            align-items: flex-start;
    margin-top: 40px;
    }

    .cs-invoice.cs-style1 .cs-note_left {
    margin-right: 10px;
    margin-top: 6px;
    margin-left: -5px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    }

    .cs-invoice.cs-style1 .cs-note_left svg {
    width: 32px;
    }

    .cs-invoice.cs-style1 .cs-invoice_left {
    max-width: 55%;
    }

    .cs-invoice_btns {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    margin-top: 30px;
    }

    .cs-invoice_btns .cs-invoice_btn:first-child {
    border-radius: 5px 0 0 5px;
    }

    .cs-invoice_btns .cs-invoice_btn:last-child {
    border-radius: 0 5px 5px 0;
    }

    .cs-invoice_btn {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    border: none;
    font-weight: 600;
    padding: 8px 20px;
    cursor: pointer;
    }

    .cs-invoice_btn svg {
    width: 24px;
    margin-right: 5px;
    }

    .cs-invoice_btn.cs-color1 {
    color: #111111;
    background: rgba(42, 209, 157, 0.15);
    }

    .cs-invoice_btn.cs-color1:hover {
    background-color: rgba(42, 209, 157, 0.3);
    }

    .cs-invoice_btn.cs-color2 {
    color: #fff;
    background: #2ad19d;
    }

    .cs-invoice_btn.cs-color2:hover {
    background-color: rgba(42, 209, 157, 0.8);
    }

    .cs-table_responsive {
    overflow-x: auto;
    }

    .cs-table_responsive > table {
    min-width: 600px;
    }

    .cs-50_col > * {
    width: 50%;
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
    }

    .cs-bar_list {
    margin: 0;
    padding: 0;
    list-style: none;
    position: relative;
    }

    .cs-bar_list::before {
    content: '';
    height: 75%;
    width: 2px;
    position: absolute;
    left: 4px;
    top: 50%;
    -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
    background-color: #eaeaea;
    }

    .cs-bar_list li {
    position: relative;
    padding-left: 25px;
    }

    .cs-bar_list li:before {
    content: '';
    height: 10px;
    width: 10px;
    border-radius: 50%;
    background-color: #eaeaea;
    position: absolute;
    left: 0;
    top: 6px;
    }

    .cs-bar_list li:not(:last-child) {
    margin-bottom: 10px;
    }

    .cs-table.cs-style1.cs-type1 {
    padding: 10px 30px;
    }

    .cs-table.cs-style1.cs-type1 tr:first-child td {
    border-top: none;
    }

    .cs-table.cs-style1.cs-type1 tr td:first-child {
    padding-left: 0;
    }

    .cs-table.cs-style1.cs-type1 tr td:last-child {
    padding-right: 0;
    }

    .cs-table.cs-style1.cs-type2 > * {
    padding: 0 10px;
    }

    .cs-table.cs-style1.cs-type2 .cs-table_title {
    padding: 20px 0 0 15px;
    margin-bottom: -5px;
    }

    .cs-table.cs-style2 td {
    border: none;
    }

    .cs-table.cs-style2 td,
    .cs-table.cs-style2 th {
    padding: 12px 15px;
    line-height: 1.55em;
    }

    .cs-table.cs-style2 tr:not(:first-child) {
    border-top: 1px dashed #eaeaea;
    }

    .cs-list.cs-style1 {
    list-style: none;
    padding: 0;
    margin: 0;
    }

    .cs-list.cs-style1 li {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    }

    .cs-list.cs-style1 li:not(:last-child) {
    border-bottom: 1px dashed #eaeaea;
    }

    .cs-list.cs-style1 li > * {
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
    width: 50%;
    padding: 7px 0px;
    }

    .cs-list.cs-style2 {
    list-style: none;
    margin: 0 0 30px 0;
    padding: 12px 0;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    }

    .cs-list.cs-style2 li {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    }

    .cs-list.cs-style2 li > * {
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
    padding: 5px 25px;
    }

    .cs-heading.cs-style1 {
    line-height: 1.5em;
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid #eaeaea;
    padding: 10px 0;
    }

    .cs-no_border {
    border: none !important;
    }

    .cs-grid_row {
    display: -ms-grid;
    display: grid;
    grid-gap: 20px;
    list-style: none;
    padding: 0;
    }

    .cs-col_2 {
    -ms-grid-columns: (1fr)[2];
        grid-template-columns: repeat(2, 1fr);
    }

    .cs-col_3 {
    -ms-grid-columns: (1fr)[3];
        grid-template-columns: repeat(3, 1fr);
    }

    .cs-col_4 {
    -ms-grid-columns: (1fr)[4];
        grid-template-columns: repeat(4, 1fr);
    }

    .cs-border_less td {
    border-color: transparent;
    }

    .cs-special_item {
    position: relative;
    }

    .cs-special_item:after {
    content: '';
    height: 52px;
    width: 1px;
    background-color: #eaeaea;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
    right: 0;
    }

    .cs-table.cs-style1 .cs-table.cs-style1 tr:not(:first-child) td {
    border-color: #eaeaea;
    }

    .cs-table.cs-style1 .cs-table.cs-style2 td {
    padding: 12px 0px;
    }

    .cs-ticket_wrap {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    }

    .cs-ticket_left {
    -webkit-box-flex: 1;
        -ms-flex: 1;
            flex: 1;
    }

    .cs-ticket_right {
    -webkit-box-flex: 0;
        -ms-flex: none;
            flex: none;
    width: 215px;
    }

    .cs-box.cs-style1 {
    border: 2px solid #eaeaea;
    border-radius: 5px;
    padding: 20px 10px;
    min-width: 150px;
    }

    .cs-box.cs-style1.cs-type1 {
    padding: 12px 10px 10px;
    }

    .cs-max_w_150 {
    max-width: 150px;
    }

    .cs-left_auto {
    margin-left: auto;
    }

    .cs-title_1 {
    display: inline-block;
    border-bottom: 1px solid #eaeaea;
    min-width: 60%;
    padding-bottom: 5px;
    margin-bottom: 10px;
    }

    .cs-box2_wrap {
    display: -ms-grid;
    display: grid;
    grid-gap: 30px;
    list-style: none;
    padding: 0;
    -ms-grid-columns: (1fr)[2];
        grid-template-columns: repeat(2, 1fr);
    }

    .cs-box.cs-style2 {
    border: 1px solid #eaeaea;
    padding: 25px 30px;
    border-radius: 5px;
    }

    .cs-box.cs-style2 .cs-table.cs-style2 td {
    padding: 12px 0;
    }

    @media print {
    .cs-hide_print {
        display: none !important;
    }
    }

    @media (max-width: 767px) {
    .cs-mobile_hide {
        display: none;
    }
    .cs-invoice.cs-style1 {
        padding: 30px 20px;
    }
    .cs-invoice.cs-style1 .cs-right_footer {
        width: 100%;
    }
    }

    @media (max-width: 500px) {
    .cs-invoice.cs-style1 .cs-logo {
        margin-bottom: 10px;
    }
    .cs-invoice.cs-style1 .cs-invoice_head {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
    }
    .cs-invoice.cs-style1 .cs-invoice_head.cs-type1 {
        -webkit-box-orient: vertical;
        -webkit-box-direction: reverse;
            -ms-flex-direction: column-reverse;
                flex-direction: column-reverse;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        text-align: center;
    }
    .cs-invoice.cs-style1 .cs-invoice_head .cs-text_right {
        text-align: left;
    }
    .cs-list.cs-style2 li {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
            -ms-flex-direction: column;
                flex-direction: column;
    }
    .cs-list.cs-style2 li > * {
        padding: 5px 20px;
    }
    .cs-grid_row {
        grid-gap: 0px;
    }
    .cs-col_2,
    .cs-col_3,
    .cs-col_4 {
        -ms-grid-columns: (1fr)[1];
            grid-template-columns: repeat(1, 1fr);
    }
    .cs-table.cs-style1.cs-type1 {
        padding: 0px 20px;
    }
    .cs-box2_wrap {
        -ms-grid-columns: (1fr)[1];
            grid-template-columns: repeat(1, 1fr);
    }
    .cs-box.cs-style1.cs-type1 {
        max-width: 100%;
        width: 100%;
    }
    .cs-invoice.cs-style1 .cs-invoice_left {
        max-width: 100%;
    }
    }

</style>
</head>

<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16"><b class="cs-primary_color">Invoice No:</b> #SM75692</p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="assets/img/logo.svg" alt="Logo"></div>
          </div>
        </div>
        <div class="cs-invoice_head cs-mb10">
          <div class="cs-invoice_left">
            <b class="cs-primary_color">Must Read:</b>
            <p class="cs-mb8">Seating is on a first come, first served basis unless you have purchased ticket for a Reserved Seating performance. Please arrive early for best seat section.</p>
            <p><b class="cs-primary_color cs-semi_bold">Date Of Services:</b> <br>25 Feb 2022</p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <b class="cs-primary_color">IVONNE UNIVERSITY</b>
            <p>
              237 Roanoke Road, North York, <br/>
              Ontario, Canada <br/>
              demo@email.com <br/>
              +1-613-555-0141
            </p>
          </div>
        </div>
        <ul class="cs-list cs-style2">
          <li>
            <div class="cs-list_left">Student ID: <b class="cs-primary_color cs-semi_bold ">AS2534568</b></div>
            <div class="cs-list_right">Balance Due: <b class="cs-primary_color cs-semi_bold ">$ 3600</b></div>
          </li>
          <li>
            <div class="cs-list_left">Student Name: <b class="cs-primary_color cs-semi_bold ">Johan Smith</b></div>
            <div class="cs-list_right">Due Date: <b class="cs-primary_color cs-semi_bold ">25 Feb 2022</b></div>
          </li>
          <li>
            <div class="cs-list_left">Term: <b class="cs-primary_color cs-semi_bold ">Winter</b></div>
            <div class="cs-list_right">Statement For: <b class="cs-primary_color cs-semi_bold ">2022 Spring</b></div>
          </li>
        </ul>
        <div class="cs-table cs-style2">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              <table>
                <thead>
                  <tr class="cs-focus_bg">
                    <th class="cs-width_5 cs-semi_bold cs-primary_color">Details</th>
                    <th class="cs-width_5 cs-semi_bold cs-primary_color">Due Date</th>
                    <th class="cs-width_2 cs-semi_bold cs-primary_color cs-text_right">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="cs-width_5">Semester Fee</td>
                    <td class="cs-width_5">25 Feb 2022</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">$60</td>
                  </tr>
                  <tr>
                    <td class="cs-width_5">Exam Fee</td>
                    <td class="cs-width_5">25 Feb 2022</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">$120</td>
                  </tr>
                  <tr>
                    <td class="cs-width_5">Transport Fee</td>
                    <td class="cs-width_5">25 Feb 2022</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">$25</td>
                  </tr>
                  <tr>
                    <td class="cs-width_5">Hostel Fee</td>
                    <td class="cs-width_5">25 Feb 2022</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">$30</td>
                  </tr>
                  <tr>
                    <td class="cs-width_5">Book Fee</td>
                    <td class="cs-width_5">25 Feb 2022</td>
                    <td class="cs-width_2 cs-text_right cs-primary_color">$20</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="cs-table cs-style2">
          <div class="cs-table_responsive">
            <table>
              <tbody>
                <tr class="cs-table_baseline">
                  <td class="cs-width_5">
                    <b class="cs-primary_color">Pay By</b><br/>
                    Credit Card - 236***************** <br/>Amount: $ 113 - Due: $ 0
                  </td>
                  <td class="cs-width_5 cs-primary_color cs-bold cs-f16 cs-text_right">Total Amount:</td>
                  <td class="cs-width_2 cs-text_right cs-primary_color cs-bold cs-primary_color cs-f16">$273</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="cs-note">
          <div class="cs-note_left">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </div>
          <div class="cs-note_right">
            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
            <p class="cs-m0">Here we can write a additional notes for the client to get a better understanding of this invoice.</p>
          </div>
        </div><!-- .cs-note -->
      </div>
      <div class="cs-invoice_btns cs-hide_print">
        <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
          <span>Print</span>
        </a>
        <button id="download_btn" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
          <span>Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/html2canvas.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>