<?php
// 
function getProjectRoot(){
    return "/banquedupeuple/";
}
function getProjectPath(){
    return "/banquedupeuple/src/";
}

function getPublicPath(){
    return "/banquedupeuple/public/";
}

function getControllerPath(String $controllerName){
    return "/banquedupeuple/src/controller/"+$controllerName;
}

function getModelPath(String $modelName){
    return "/banquedupeuple/src/controller/"+$modelName;
}

?>