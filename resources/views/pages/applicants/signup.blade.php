@extends('layout.app')
    @section('content')
        <div class="text-center text-primary m-auto">
            <h1 class="display-3 p-3">Create your Account</h1>
            <h6>step 1 out of 3</h6>

            <form class="p-1 mt-4" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <input class="m-auto form-control w-25 mt-3 p-2" type="text" name="user" placeholder="Username">
                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="repass" placeholder="Password">
                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="pass" placeholder="Confirm Password">

                <button type="submit" class="btn btn-primary w-25 mt-3 ">Sign up</button>
            </form>
        </div>
    @endsection