<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
        <?php
        if($this->side_info_content)
            $this->widget('bootstrap.widgets.TbBox', array(
            'title' => 'Info',
            'headerIcon' => 'icon-info-sign',
            'content' => $this->side_info_content,
            ));
        ?>

        <?php
        if($this->menu){
            $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Operation',
            'headerIcon' => 'icon-cog',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>$this->menu,
            ));
            $this->endWidget();
        }
        ?>

        <?php
            echo $this->side_nav_content;
        ?>

        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>