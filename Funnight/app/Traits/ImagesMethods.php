<?php

namespace App\Traits;

use App\Image;
use App\Event;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait ImagesMethods
{
    /**
     * Función que verifica si el usuario esta activo.
     *
     * @return bool
     */
    
    public function typePublication($image_id)
    {
        $image = Image::find($image_id);
        $text = "";

        if ($image->typePub != null) {
            if ($image->typePub==1) {
                #promocion
                $promotion = Promotion::where('image_id', $image->id)->first();
                $text = "Promoción valida desde: ".date_format(date_create($promotion->initial_date), 'd/m/Y')." hasta ".date_format(date_create($promotion->final_date), 'd/m/Y');
            } else {
                #evento
                $event = Event::where('image_id', $image->id)->first();
                // dd($event);
                $text = "Fecha del evento: ".date_format(date_create($event->event_date), 'd/m/Y');
            }
        }

        return $text;
    }
}
