<?php
function branch_name() {
    return '//'.filter_input(INPUT_SERVER, 'HTTP_HOST').'/';
}
