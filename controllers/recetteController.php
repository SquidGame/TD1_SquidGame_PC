<?php

require_once './models/recetteModel.php';

class RecetteController {
    public static function showLatestRecipes($conn) {
        $latestRecipes = RecetteModel::getLatestRecipes($conn);
        require './views/body.php';
    }
}


?>