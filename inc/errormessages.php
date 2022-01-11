<?php

if (count($errors) > 0) {
    echo '<div class="error">';
    echo '<ul>';
    foreach ($errors as $value) {
        echo "<li>$value</li>";
    }
    echo '</ul>';
    echo '</div>';
}