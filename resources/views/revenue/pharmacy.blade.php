<!--Revenue Pharmacy View-->
<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height:70vh;">
        <div class="card col-md-8 col-lg-6 p-3 animation__wobble">
            <div class="d-flex flex-row border-container">
                <div><img src="storage/pharmacies_Images/{{$pharmacy['avatar_image']}}" class="img-circle" width="60px"></div>
                <div class="card-title align-middle ml-3 mt-3">{{$pharmacy['pharmacy_name']}}</div>
            </div>

            <div class="card-body">
                <ul class="nav nav-pills nav-sidebar flex-column gap-1" data-widget="treeview" role="menu" data-accordion="false" style="font-family: nunito;letter-spacing:1px;">
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/ID-icon.png" class="nav-icon">
                        <strong>ID: </strong><span>{{$pharmacy['id']}}</span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Orders-icon.png" class="nav-icon">
                        <strong>Total Orders: </strong><span>{{$orders}}</span>
                    </li>
                    <li class="nav-item sidebar-list">
                        <img src="dist/img/icons/Revenue-icon.png" class="nav-icon">
                        <strong>Total Revenue: </strong><span>{{$revenues}} $</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

