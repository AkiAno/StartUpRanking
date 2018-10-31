@extends('layouts.app')

<link rel="stylesheet" href="/css/main.css">

@section('content')

<div class="container flex">
    <div class="month">
        <label>
            Month
            <input type="radio" data-role="segmented" name="view" value="month" class="md-view-change"  checked>
        </label>
        <div id="demo"></div>
    </div>
    <div class="month">
        <label>
            Month
            <input type="radio" data-role="segmented" name="view" value="month" class="md-view-change"  checked>
        </label>
        <div id="demo"></div>
    </div>
</div>

<div class="data container">
        <table class="table table-lg-responsive">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Company's name
                    </th>
                    <th>
                        Alexa rank
                    </th>
                    <th>
                        Facebook followers
                    </th>
                    <th>
                        Instagram followers
                    </th>
                    <th>
                        Twitter followers
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                            1
                    </th>
                    <td>
                        Company 1
                    </td>
                    <td class="td">
                        #125
                    </td>
                    <td class="td">
                        1,234,122
                    </td>
                    <td class="td">
                        1,340,098
                    </td>
                    <td class="td">
                        929,222
                    </td>
                </tr>
                <tr>
                        <th>
                                2
                        </th>
                        <td>
                            Company 2
                        </td>
                        <td class="td">
                            #200
                        </td>
                        <td class="td">
                            1,000,122
                        </td>
                        <td class="td">
                            1,123,004
                        </td>
                        <td class="td">
                            500,234
                        </td>
                    </tr>
            </tbody>
        </table>
</div>

@endsection