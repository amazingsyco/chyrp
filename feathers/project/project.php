<?php
    class Project extends Feathers implements Feather {
        public function __init() {
            $this->setField(array("attr" => "title",
                                  "type" => "text",
                                  "label" => __("Project Name", "text"),
                                  "bookmarklet" => "title"));

			$this->setField(array("attr" => "source",
			                      "type" => "text",
			                      "label" => __("URL", "link"),
								  "optional" => true,
			                      "bookmarklet" => "url"));

            $this->setField(array("attr" => "body",
                                  "type" => "text_block",
                                  "label" => __("About", "text"),
                                  "preview" => true,
                                  "bookmarklet" => "selection"));

			$this->setField(array("attr" => "project_status",
			                      "type" => "text_block",
			                      "label" => __("Status", "text"),
			                      "preview" => true,
			                      "bookmarklet" => "selection"));

            $this->setFilter("title", array("markup_title", "markup_post_title"));
            $this->setFilter("body", array("markup_text", "markup_post_text"));
            $this->setFilter("project_status", array("markup_text", "markup_post_text"));
        }

        public function submit() {
            if (empty($_POST['body']))
                error(__("Error"), __("Body can't be blank."));

            fallback($_POST['slug'], sanitize($_POST['title']));

            return Post::add(array("title" => $_POST['title'],
									"source" => $_POST['source'],
                                    "body" => $_POST['body'],
									"project_status" => $_POST['project_status']),
                             $_POST['slug'],
                             Post::check_url($_POST['slug']));
        }

        public function update($post) {
            if (empty($_POST['body']))
                error(__("Error"), __("Body can't be blank."));

            $post->update(array("title" => $_POST['title'],
								"source" => $_POST['source'],
                                "body" => $_POST['body'],
								"project_status" => $_POST['project_status']));
        }

        public function title($post) {
			return $post->title;
        }

        public function excerpt($post) {
            return $post-body;
        }

        public function feed_content($post) {
            return $post->body;
        }
    }
