<?php
    use vista\Vista;

    class AdminController
    {
        public function index(){
            return vista::crear("admin.index");
        }
    }