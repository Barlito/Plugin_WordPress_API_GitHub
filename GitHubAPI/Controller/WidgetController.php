<?php

class WidgetController extends WP_Widget {

    public function __construct() {
        parent::__construct('github_api', 'GitHub API', array('description' => 'Affiche les commits d\'un repository via l\'API de GitHub'));
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $id = isset($instance['id']) ? $instance['id'] : '';
        $pass = isset($instance['pass']) ? $instance['pass'] : '';
        $repo = isset($instance['repo']) ? $instance['repo'] : '';
        $comm = isset($instance['comm']) ? $instance['comm'] : '';
        ?>
        <p>

            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Titre :'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
                   type="text" value="<?php echo $title; ?>" />

            <label for="<?php echo $this->get_field_name('id'); ?>"><?php _e('Identifiant GitHub :'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>"
                   type="text" value="<?php echo $id; ?>" />

            <label for="<?php echo $this->get_field_name('pass'); ?>"><?php _e('Mot de passe GitHub :'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pass'); ?>" name="<?php echo $this->get_field_name('pass'); ?>"
                   type="password" value="<?php echo $pass; ?>" />

            <?php
            if ($id && $pass != NULL) {
                require_once 'ApiController.php';
                $repos = ApiController::auth($id, $pass);
                if ($repos != NULL) {
                    ?>
                    <label for="<?= $this->get_field_name('repo'); ?>"><?php _e('Choississez un repository : '); ?></label>
                    <select class="widefat" id="<?= $this->get_field_id('repo'); ?>" name="<?= $this->get_field_name('repo'); ?>">
                        <?php
                        foreach ($repos as $unRepo) {
                            ?>
                            <option value="<?= $unRepo['name']; ?>" <?= ($repo == $unRepo['name']) ? 'selected' : ''; ?> ><?= $unRepo['name']; ?></option>
                        <?php } ?>
                    </select>

                    <label for="<?php echo $this->get_field_name('comm'); ?>"><?php _e('Nombre de commits à afficher ( max 10 )'); ?></label>
                    <select class="widefat" id="<?= $this->get_field_id('comm'); ?>" name="<?= $this->get_field_name('comm'); ?>">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            ?>
                            <option value="<?= $i ?>" <?= ($comm == $i) ? 'selected' : ''; ?> ><?= $i ?></option>
                        <?php } ?>
                    </select>

                    <?php
                } else {
                    echo "Mauvais login ou mot de passe <br>";
                }
            }
            ?>
        </p>
        <?php
    }

    public
            function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        echo $args['before_id'];
        ?>
        <h3>Voici les <?= apply_filters('widget_id', $instance['comm']) ?> derniers commits de <?= apply_filters('widget_id', $instance['id']); ?> sur son repository :
            <?= apply_filters('widget_id', $instance['repo']); ?></h3>
        <?php
        //Récup de tout les commits
        $commits = ApiController::getCommit(apply_filters('widget_id', $instance['id']), apply_filters('widget_id', $instance['repo']));
        ?>
        <ul>
            <?php
            foreach ($commits as $unCommit) {
                if (++$i > apply_filters('widget_id', $instance['comm']))
                    break;
                ?>

                <li><a href="<?= $unCommit[html_url] ?>"><?= $unCommit[commit][message] ?></a></li>

                <?php
            }
            ?>
        </ul>
        <?php
        echo $args['after_id'];
        echo $args['after_widget'];
    }

}
