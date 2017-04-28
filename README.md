FuelPHP-Alert-Messages
================

Messages package for FuelPHP. Allows you to easily log and report messages.

     Messages::info('This is my message.');
     Messages::info('This is my message.', 'Hello');
     Messages::error('Unable to determine why the printer is not responding.', 'Printer on fire!');
     
It is inspired by the [Message package by dbpolito](https://github.com/dbpolito/Fuel-Message). There are however a few key differences:

* Support alert message with redirect page.
* Support for block or thin Bootstrap alerts.
* Suport javascript alert message, or [Bootbox](http://bootboxjs.com/) alert message.
* Deferred rendering. The `Messages::get` method returns an array of View instances rather than a string.
* Messages are rendered in the order they are logged irrelevant of the message type (e.g. info or error).
* An optional title can be passed to the message methods. `Messages::error('full message', 'title')`

Just like dbpolito's Message package the generated HTML makes use of [Bootstrap](http://twitter.github.com/bootstrap) CSS classes

Configuration
==================
  1. Copy all file to fuel\package\messages
  2. Copy file fuel\packages\messages\config\messages.php to \fuel\app\config and change it.

    return array(
      'js_alert_plugin' => 'default', // jQuery alert plugin: default || bootbox
      'js_message_sesion_name' => 'js_message_sesion_name', // Sesion name 
      'default_message_session_name' => 'default_message_session_name' // Sesion name 
    );

  Note: if using [Bootstrap](http://twitter.github.com/bootstrap) 
  1. Add 
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
   
  2. Change 
  
    'js_alert_plugin' => 'bootbox',
    
  
Usage
====================

  Using in curent page

    public function action_index() {
      \Messages::success('what you just did worked');
      \Messages::js('something is really wrong', 'Thông báo');

      $this->template = \View::forge('empty');
      $view = \View::forge('home/index', $this->data);
      $this->template->content = $view;
    }
    
  Using with redirect page
  
    public function action_index() {
      \Messages::success('what you just did worked');
      \Messages::js('something is really wrong', 'Thông báo');
      return \Fuel\Core\Response::redirect('home/index');
    }

Registering messages
====================

By defaul 5 types of messages can be registered:

    Messages::info('this is an information message');
    Messages::warning('something is not right');
    Messages::error('something is really wrong';
    Messages::success('what you just did worked');
    Messages::js('what you just did worked'); // javascript only

You can provide an option message title by passing two arguments:

    Messages::warning('The email address <em>foo@bar</em> is not a valid email address.', 'Invalid email address');

Rendering messages
==================

The `Messages::get()` method returns an array of View instances. 

    <div class="container-fluid">
      <?php echo \Messages::get(); ?>
      <?php echo $content; ?>
    </div>
