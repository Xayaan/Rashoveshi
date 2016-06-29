@extends('rashoveshi.layouts.default')

@section('content')
<div class="main-area categoryPg">
  <div class="row ">
    <div class="large-12 column nopadding report-bar">
      ރަށޮވެށިއަށް ޚަބަރެއް ދެއްވުމަށް: 7422233 / 9572233
    </div>
    <div class="clearfix"></div>
    
    <div class="large-8 medium-12 column right nopadding-right">
      {{-- Featured --}}
      {{-- @include('rashoveshi.tags.featured', $posts['posts']) --}}
    </div>

    {{-- Recent and Populars --}}
    <div class="large-4 column left recents-popular nopadding-left show-for-large-up">
      {{-- TABS --}}
      @include('rashoveshi.home.recent-listing-home')
      @include('rashoveshi.polls.latest-poll')
    </div>
  </div>
</div>

@stop