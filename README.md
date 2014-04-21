# Register Hooks
Hook callback registration module for Drupal 7. Allows developer to use any PHP callable to implement Drupal hooks, instead of modulename_hookname() functions.

register_hooks  Copyright (C) 2014  John A Dillick
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------------------

Example Drupal Hook registration using real callbacks (not just functions).

```php
/**
 * Register a static method Test::init() to implement hook_init() for module my_module_name.
 */
register_hooks_register('my_module_name', 'init', array('Test','init'));
class Test {
  /**
   * Implements hook_init().
   * Believe it or not.
   */
  static function init() {
    // do hook_init stuff
  }
}

/**
 * Register the instantiated object's method Test2::form_alter() to implement form_alter()
 * for module my_module_name.
 */
register_hooks_register('my_module_name', 'form_alter', array(new Test2(), 'form_alter'));
class Test2 {
  /**
   * Implements hook_form_alter().
   * No joke.
   */
  function form_alter(&$form, &$form_state, $form_id) {
    $form['blah'] = array(
      '#type' => '',
      '#title' => t(''),
      '#default_value' => $settings[''],
      '#required' => ,
      '#element_validate' => array(''),
      '#description' => t(''),
    );
  }
}
```

If your module were using xautoload, by donquixote, this class would be autoloaded from
my_module_name/lib/Drupal/my_module_name/MyClass.php whenever hook_views_data() was invoked, and
the static method my_method() would be called.

```php
register_hooks_register('my_module_name', 'views_data', array(
    'Drupal\my_module_name\MyClass', 'my_method'
  )
);
```
