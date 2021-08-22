<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJ Freeway | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <style>
        .header-logo {
            max-width: 13rem;
        }
    </style>

</head>

<body>

    <main>
        <header>
            <div class="px-3 py-2 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="{{ url('user') }}" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                            <img src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://mjplatform.com/wp-content/uploads/2020/12/mjfreeway_logolockup_rev_HOR.png" data-src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://mjplatform.com/wp-content/uploads/2020/12/mjfreeway_logolockup_rev_HOR.png" class="header-logo" alt="MJ Freeway" title="MJ Platform">
                        </a>

                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href="{{ url('logout') }}" class="nav-link text-white">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <br>

        <div class="container-fluid text-center">
            <div><strong>Caffeine Consumption: {{ $consumptions['consumed'] }}</strong></div>
        </div>

        <br>

        <div class="container">
            <h3>Favorite Drinks</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Drink</th>
                        <th>Caffeine</th>
                        <th>Consumable</th>
                        <th></th>
                    </tr>
                </thead>

                @foreach($drinks as $drink)
                <tr>
                    <form action="{{ url('user/consumptions/add') }}" method="post" name="add-drink-{{ $drink['id'] }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $drink['id'] }}">
                        <td>{{$drink['name']}}</td>
                        <td>{{$drink['caffeine']}}</td>
                        <td>
                            @if($consumptions['consumable'] > $drink['caffeine'])
                            <span class="badge bg-success">Yes</span>
                            @else
                            <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td><button type="submit" class="btn btn-sm btn-warning">Add</button></td>
                    </form>
                </tr>
                @endforeach
            </table>
        </div>

        <br>

        <div class="container">
            <h3>Today's consumptions</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Drink</th>
                        <th>Caffeine</th>
                    </tr>
                </thead>

                @forelse($consumptions['consumptions'] as $consumption)
                <tr>
                    <td>{{$consumption['drink']['name']}}</td>
                    <td>{{$consumption['drink']['caffeine']}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">You have not drank anything today.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </main>
</body>

</html>