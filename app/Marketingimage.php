<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketingimage extends Model
{
    protected $table = 'marketing_images';
    //https://laravel.com/docs/5.3/eloquent#mass-assignment
    protected $fillable = ['is_active',
	                       'is_featured',
	                       'image_name',
	                       'image_path',
	                       'image_extension',
	                       'mobile_image_name',
	                       'mobile_image_path',
	                       'mobile_extension'
    ];

    public function store(CreateImageRequest $request)
	{
   		//create new instance of model to save from form

	   $marketingImage = new Marketingimage([
	       'image_name'        => $request->get('image_name'),
	       'image_extension'   => $request->file('image')->getClientOriginalExtension(),
	       'mobile_image_name' => $request->get('mobile_image_name'),
	       'mobile_extension'  => $request->file('mobile_image')->getClientOriginalExtension(),
	       'is_active'         => $request->get('is_active'),
	       'is_featured'       => $request->get('is_featured'),

	   ]);

	   //define the image paths

	   $destinationFolder = '/imgs/marketing/';
	   $destinationThumbnail = '/imgs/marketing/thumbnails/';
	   $destinationMobile = '/imgs/marketing/mobile/';

	   //assign the image paths to new model, so we can save them to DB

	   $marketingImage->image_path = $destinationFolder;
	   $marketingImage->mobile_image_path = $destinationMobile;

	   // format checkbox values and save model

	   $this->formatCheckboxValue($marketingImage);
	   $marketingImage->save();

	   //Concludes storage of data to database. Next part handles image parts into file dirs

	   //parts of the image we will need

	   $file = Input::file('image');

	   $imageName = $marketingImage->image_name;
	   $extension = $request->file('image')->getClientOriginalExtension();

	   //create instance of image from temp upload

	   $image = Image::make($file->getRealPath());

	   //save image with thumbnail

	   $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
	       ->resize(60, 60)
	       // ->greyscale()
	       ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);

	   // now for mobile

	   $mobileFile = Input::file('mobile_image');

	   $mobileImageName = $marketingImage->mobile_image_name;
	   $mobileExtension = $request->file('mobile_image')->getClientOriginalExtension();

	   //create instance of image from temp upload
	   $mobileImage = Image::make($mobileFile->getRealPath());
	   $mobileImage->save(public_path() . $destinationMobile . $mobileImageName . '.' . $mobileExtension);


	   // Process the uploaded image, add $model->attribute and folder name

	   //Need Jeffrey Way's flash package for this https://github.com/laracasts/flash
	   //flash()->success('Marketing Image Created!');

	   return redirect()->route('marketingimage.show', [$marketingImage]);
	}

}

