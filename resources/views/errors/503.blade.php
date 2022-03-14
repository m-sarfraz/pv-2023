@extends('errors::minimal')

@section('title', __('Server is Down for maintanance!'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Server is Down for maintanance!'))
