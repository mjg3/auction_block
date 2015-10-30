<div id='errors'>
<?php
        if($this->session->flashdata('errors'))
        {
            foreach($this->session->flashdata('errors') as $value)
            {
?>
                <div class="alert alert-danger" role="alert">
                    <p><?= $value ?></p>
                </div>
<?php       }
        }
?>
</div>
<div id='success'>
<?php
        if($this->session->flashdata('success'))
        {
            foreach($this->session->flashdata('success') as $value)
            { ?>
                <p><?= $value ?></p>
<?php
            }
        }
?>
</div>
