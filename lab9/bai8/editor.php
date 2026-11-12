<?php
function editor_assets() { echo '<link rel="stylesheet" href="../assets/ckeditor5/ckeditor5.css"><script src="../assets/ckeditor5/ckeditor5.umd.js"></script><script src="../assets/editor.js"></script>'; }
function editor_replace_all() { echo '<script>document.querySelectorAll("textarea").forEach(attachEditor);</script>'; }
