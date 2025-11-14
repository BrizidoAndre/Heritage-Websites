<?php

namespace app\models;

use yii\helpers\Html;
use yii\helpers\Url;

class FileModel
{
    public $title;
    public $tags;
    public $image;
    public $draft;
    public $raw;
    public $content;
    public $summary;
    public $date;
    public $rawFilePath;
    public $pascalFilePath;
    public $extention;
    public $urlFilePath;

    public function __construct($path)
    {
        $this->rawFilePath = $path;
        $this->raw = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->getMetaData();
        $this->getNames();
        $this->formatContent();
        $this->getRealTitle();
    }

    public function getMetaData()
    {
        $positions = array_filter($this->raw, function ($line) {
            return $line === '---';
        });
        if (!isset($positions[0])) {
            return null;
        }
        $positions = array_keys($positions);
        $metaDatas = array_slice($this->raw, $positions[0] + 1, $positions[1] - 1);

        foreach ($metaDatas as $metaData) {
            if (str_contains($metaData, 'title: ')) {
                $this->title = str_replace('title: ', '', $metaData);
            }
            if (str_contains($metaData, 'summary: ')) {
                $this->summary = str_replace('summary: ', '', $metaData);
            }
            if (str_contains($metaData, 'cover: ')) {
                $this->image = str_replace('cover: ', '', $metaData);
            }
            if (str_contains($metaData, 'draft: ')) {
                $this->draft = str_replace('draft: ', '', $metaData);
            }
            if (str_contains($metaData, 'tags: ')) {
                $tags = str_replace('tags: ', '', $metaData);
                $tags = explode(', ', $tags);
                if (count($tags) ===1) {
                    $tags = explode(',', $tags[0]);
                }
                $this->tags = $tags;
            }
        }

        if (isset($positions[1])) {
            $this->formatContent($positions[1]);

        }
    }

    public function getNames()
    {
        $this->extention = substr($this->rawFilePath, strrpos($this->rawFilePath, '.'));
        $this->pascalFilePath = substr($this->rawFilePath, strrpos($this->rawFilePath, '/') + 12);
        $this->pascalFilePath = str_replace(['-', '.txt', '.html'], [' ', '', ''], $this->pascalFilePath);
        $this->pascalFilePath = ucwords($this->pascalFilePath);
        $this->urlFilePath = str_replace(['./content-pages/', '.txt', '.html'], '', $this->rawFilePath);
        $this->date = substr($this->rawFilePath, strrpos($this->rawFilePath, '/') + 1, 10);
    }

    public function formatContent($lastPositionMeta = 0)
    {
        if ($lastPositionMeta) {
            $this->content = array_slice($this->raw, $lastPositionMeta + 1);
        }

        if ($this->extention === '.txt') {
            foreach ($this->content as $id => $item) {
                $this->content[$id] = '<p>' . $item . '</p>';
            }
        }
    }

    public function getRealTitle()
    {
        if ($this->title) {
            return null;
        }
        if ($this->extention === '.html') {
            foreach ($this->content as $id => $line) {
                if (str_contains($line, '<h1>')) {
                    $this->title = str_replace(['<h1>', '</h1>'], '', $line);
                    $this->content[$id] = '';
                }
            }
        }
        if (!$this->title) {
            $this->title = $this->date . ' ' . $this->pascalFilePath;
        }
    }
}