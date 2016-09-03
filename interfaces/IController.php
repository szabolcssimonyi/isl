<?php

interface IController{
    function getModel();
    function renderView($view,$params=null);
    function indexAction();
}
