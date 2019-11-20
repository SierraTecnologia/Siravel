<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 22/07/17
 * Time: 01:52
 */
?>
<li class="{{ Request::is('*home*') ? 'active' : '' }}">
    <a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i><span>{!! trans('words.dashboard') !!}</span></a>
</li>


<li class="{{ Request::is('admin.clients*') ? 'active' : '' }}">
    <a href="{!! route('clients.index') !!}"><i class="fa fa-group"></i><span>{!! trans('words.clients') !!}</span></a>
</li>


<li class="{{ Request::is('admin.contacts*') ? 'active' : '' }}">
    <a href="{!! route('contacts.index') !!}"><i class="fa fa-phone"></i><span>{!! trans('words.contacts') !!}</span></a>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart"></i> <span>{!! trans('words.reports') !!}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="{{ Request::is('admin.accounts*') ? 'active' : '' }}">
            <a href="{!! route('accounts.index') !!}"><i class="fa fa-key"></i><span>{!! trans('words.accounts') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.emails*') ? 'active' : '' }}">
            <a href="{!! route('emails.index') !!}"><i class="fa fa-envelope"></i><span>{!! trans('words.emails') !!}</span></a>
        </li>
        <li class="{{ Request::is('*logs*') ? 'active' : '' }}">
            <a href="{!! route('admin.logs') !!}"><i class="fa fa-file-text"></i><span>{!! trans('words.logs') !!}</span></a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-gavel"></i> <span>{!! trans('words.admin') !!}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="{{ Request::is('admin.accountCategories*') ? 'active' : '' }}">
            <a href="{!! route('accountCategories.index') !!}"><i class="fa fa-share"></i><span>{!! trans('words.accountCategories') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.services*') ? 'active' : '' }}">
            <a href="{!! route('services.index') !!}"><i class="fa fa-flash"></i><span>{!! trans('words.services') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.dominios*') ? 'active' : '' }}">
            <a href="{!! route('dominios.index') !!}"><i class="fa fa-laptop"></i><span>{!! trans('words.dominios') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}"><i class="fa fa-child"></i><span>{!! trans('words.users') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.roles*') ? 'active' : '' }}">
            <a href="{!! route('roles.index') !!}"><i class="fa fa-users"></i><span>{!! trans('words.groups') !!}</span></a>
        </li>
        <li class="{{ Request::is('admin.permissions*') ? 'active' : '' }}">
            <a href="{!! route('permissions.index') !!}"><i class="fa fa-eye"></i><span>{!! trans('words.permissions') !!}</span></a>
        </li>
    </ul>
</li>
