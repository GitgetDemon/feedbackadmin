@extends('admin.dashboard.pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="col-12 text-danger">
                <h2 class="text-center">Fontos</h2>
                    A kérdőív kitöltéséhez szükséges a kitöltő vevőkódja és a szállítási levél száma!
                <br>
                    A program ezeket az adatokat az RMA rendszerbe feltöltött táblákból szerzi.
                <br>
                    Ha nem talál megfelelő azonosítót, akkor a kérdőív kitöltését nem engedélyezi.
            </div>
            <hr>
            <div class="col-12">
                <h2 class="text-center">Kérdőív létrehozásának menete</h2>
                    <ol>
                        <li>
                            Kérdés létrehozása
                        </li>
                        <li>
                            Kérdőív lap létrehozása
                        </li>
                        <li>
                            Kérdések hozzáfűzése a kérdőív lapokhoz (lásd Kérdőív lap módosítása)
                        </li>
                        <li>
                            Kérdőív összeállítása
                        </li>
                        <li>
                            Kérdőív publikálása
                        </li>
                    </ol>
            </div>
            <hr>
            <div class="col-12">
                <h2 class="text-center">Kérdőív publikálása tudnivalók</h2>
                    <ul>
                        <li>
                            Publikálás után a publikált kérdőív verzió nem módosítható.
                        </li>
                        <li>
                            Kérdőív változtatásához új publikációra van szükség.
                        </li>
                        <li>
                            A kérdőívet kitöltő személyek mindig azt a kérdőív verziót töltik ki, amely akkor aktuális mikor az e-mailből megnyitja a hivatkozást.
                        </li>
                    </ul>
            </div>
            <hr>
            <div class="col-12">
                <h2 class="text-center">Egyéb beállítások</h2>
                    <div>
                        A helyes működés érdekében érdemes az Egyéb beállítások minden mezejét kitölteni és elmenteni.
                    </div>
                </div>
        </div>
    </div>
@endsection