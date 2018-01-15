<img src="http://revotica.hu/sites/default/files/logo_0.jpg" class="img-fluid">
<nav class="navbar">
        <ul class="navbar-nav btn-group-vertical col-12 menu-part">
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.questions')}}">Új kérdés</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.choosequestion')}}">Kérdés módosítás</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.questiondeletable')}}">Kérdés törlés</a>
            </li>
        </ul>

        <ul class="navbar-nav btn-group-vertical col-12 menu-part">
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.pages')}}">Új kérdőív lap</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.modifypage')}}">Kérdőív lap módosítás</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.pagedeletable')}}">Kérdőív lap törlés</a>
            </li>
        </ul>

        <ul class="navbar-nav btn-group-vertical col-12 menu-part">
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.modifyQuestionnaire')}}">Kérdőív összeállítása</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.showEditedQuestionnaire')}}">Kérdőív publikálás</a>
            </li>
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="#">Részletes kérdőív infó</a>
            </li>
        </ul>

        <ul class="navbar-nav btn-group-vertical col-12 menu-part">
            <li class="nav-item btn btn-success">
                <a class="nav-link menulink" href="{{route('admin.settings')}}">Egyéb beállítások</a>
            </li>
        </ul>
 </nav>

@push('styles')
    <style>
        .menu-part{
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .menulink{
            color:white;
        }
        .menulink:hover
        {
            color:white;
        }
    </style>
@endpush