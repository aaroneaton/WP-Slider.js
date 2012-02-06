# WP Slider.js #
A photo/feature slider for WordPress using [Slider.js](http://sliderjs.org/) by [Gaetan Renaudeau](http://gaetanrenaudeau.fr/)

## Features ##
* Make a slideshow out of the featured images of any category.
* Easy-to-use template tag.

## Installation ##
1. Download the .zip of this repository [here](https://github.com/channeleaton/WP-Slider.js/downloads).
2. In your WordPress admin page, go to Plugins->Add New->Upload and upload the .zip file.
3. There is no third step.

### Options ###
Currently there are only six options to set:

* $name (required) - This should be a unique class name.
* $category (required) - This is the __category ID__, not the category slug.
* $image_limit - You can limit the query results. Defaults to 3.
* $height - The height of the slider in pixels. Defaults to 800.
* $width - The width of the slider in pixels. Defaults to 600.
* $duration - Time (in milliseconds) for each slide. Defaults to 5000.

## Usage ##
Use the template tag `wp_slider_js()` anywhere in your theme via hard-coding in your template files or using hooks.

### Example ###
```php	
<?php wp_slider_js( 'slider_test', 218, 4, 400, 150, 6000 ); ?>
```
Here we are calling the template tag where the name is `slider_test`, the category ID is `218`, the image limit is `4`, height is `400`, width is `150`, and the duration is `6000`.

## Known Issues ##
* If you are using W3TotalCache, sliders will not work unless JS minifying is disabled.

## Upcoming Features ##
* Allow user to select transitions
* Allow user to select theme
* Flickr integration
* Use shortcodes inside posts, pages, & text widgets
* Make the parameters easier to set

## License ##
Copyright 2012 J. Aaron Eaton

   Licensed under the Apache License, Version 2.0 \(the "License"\);
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       <http://www.apache.org/licenses/LICENSE-2.0<

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.