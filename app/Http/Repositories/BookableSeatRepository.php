<?php

namespace App\Repositories;

use App\BookableSeat;
use App\Movie;

class BookableSeatRepository
{
    protected $model;

    public function __construct(BookableSeat $model, Movie $movie)
    {
        $this->model = $model;
        $this->movie = $movie;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function show($id)
    {
        return $this->movie
            ->find($id)
            ->bookable_seats()
            ->first();
    }

    public function create($id)
    {
        $numberOfRow = rand(4,16);
        $numberOfColumn = rand(4,16);

        $seat = [];

        for ($i = 0; $i < $numberOfRow; $i++) {
            $row = [];
            for ($j = 0; $j < $numberOfColumn; $j++) {
                array_push($row, rand(0, 1));
            }
            array_push($seat, $row);
        }

        $available_seat = json_encode($seat);

        $data = $this->movie->find($id)
            ->bookable_seats()
            ->create([
                'available_seat' => $available_seat,
            ]);

        return $data;
    }

    public function updateSeat($id, $input)
    {
        $bookable_seat = $this->movie
            ->find($id)
            ->bookable_seats()
            ->first();

        dd($input);

        return $data;
    }
}
