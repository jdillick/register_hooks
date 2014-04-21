# Register Hooks
Hook callback registration module for Drupal 7. Allows developer to use any PHP callable to implement Drupal hooks, instead of modulename_hookname() functions.

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
