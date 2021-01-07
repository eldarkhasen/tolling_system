<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
//roads
Breadcrumbs::for('road.index', function ($trail) {
    $trail->push('Roads', route('roads.index'));
});

Breadcrumbs::for('road.show', function ($trail, $road) {
    $trail->parent('road.index');
    $trail->push('Road: '. $road->name, route('roads.show', $road->id));
});

//users
Breadcrumbs::for('user.index', function ($trail) {
    $trail->push('Users', route('users.index'));
});


Breadcrumbs::for('user.show', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push('User: '. $user->name, route('users.show', $user->id));
});

//cars
Breadcrumbs::for('car.index', function ($trail) {
    $trail->push('Cars', route('cars.index'));
});


Breadcrumbs::for('car.show', function ($trail, $car) {
    $trail->parent('car.index');
    $trail->push('Car: '. $car->name, route('cars.show', $car->id));
});
