@extends('layouts.ct')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Terms</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>

        <div class="container">
            <h1>Report Site Issues</h1>
            <p>If you encounter any issues while using our website, please use the form below to report them. We appreciate your feedback and will work to resolve any problems as quickly as possible.</p>

            <form method="POST" action="{{ route('report.issue.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="issue">Describe the Issue:</label>
                    <textarea id="issue" name="issue" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="email">Your Email (optional):</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </body>

@endsection
