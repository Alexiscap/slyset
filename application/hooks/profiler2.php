<<<<<<< HEAD
<?php

class MY_Profiler2 {

    private $CI;

    public function enable() {
        $this->CI = & get_instance();

        $this->CI->output->enable_profiler(TRUE);
    }

}

=======
<?php

class MY_Profiler2 {

    private $CI;

    public function enable() {
        $this->CI = & get_instance();

        $this->CI->output->enable_profiler(TRUE);
    }

}

>>>>>>> 288ecf8... correction de mes bugs
