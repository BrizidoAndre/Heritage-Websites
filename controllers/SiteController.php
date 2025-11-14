<?php

namespace app\controllers;

use app\models\FileModel;
use app\models\UploadForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($url = '')
    {
        $url = '/' . $url;
        if (is_file('./content-pages' . $url . '.txt')) {
            $file = new FileModel('./content-pages' . $url . '.txt');
            return $this->render('page', [
                'file' => $file
            ]);
        }
        if (is_file('./content-pages' . $url . '.html')) {
            $file = new FileModel('./content-pages' . $url . '.html');
            return $this->render('page', [
                'file' => $file
            ]);
        }
        $folders = $this->findDirectories($url);
        $files = $this->findFiles($url);

        return $this->render('index', [
            'files' => $files,
            'folders' => $folders,
        ]);
    }


    public function findFiles($url, $recursive = false)
    {
        $files = FileHelper::findFiles('./content-pages/' . $url, [
            'recursive' => $recursive,
            'filter' => function ($filePath) {
                $lastPath = strrpos($filePath, '/');
                $fileName = substr($filePath, $lastPath);
                $year = substr($fileName, 1, 4);
                $month = substr($fileName, 6, 2);
                $day = substr($fileName, 9, 2);
                return is_numeric($year) && is_numeric($month) && is_numeric($day);
            }
        ]);
        sort($files);
        $files = array_reverse($files);
        $fileModels = [];
        foreach ($files as $file) {
            $fileModels[] = new FileModel($file);
        }
        $fileModels = array_filter($fileModels, function ($file) {
            return $file->draft !== 'true';
        });

        return $fileModels;
    }

    public function findDirectories($url)
    {
        $files = FileHelper::findDirectories('./content-pages' . $url, [
            'recursive' => false,
            'filter' => function ($fileName) {
                return !str_contains($fileName, 'images');
            }
        ]);
        sort($files);
        $folders = [];
        foreach ($files as $path) {
            $folders[] = [
                'path' => str_replace('/content-pages', '', $path),
                'label' => substr($path, strrpos($path, '/') + 1)
            ];
        }
        return $folders;
    }

    public function actionTags($tags)
    {
        $files = FileHelper::findFiles('./content-pages', [
            'except' => [
                '*.jpg',
                '*.png',
                '*.jpeg'
            ]
        ]);
        $fileModels = [];
        foreach ($files as $file) {
            $file = new FileModel($file);
            $fileModels[] = $file;
        }
        $filter = array_filter($fileModels, function ($file) use ($tags) {
            if ($file->tags) {
                foreach ($file->tags as $tag) {
                    if ($tag === $tags) {
                        return true;
                    }
                }
            }
            return false;
        });


        return $this->render('index', [
            'files' => $filter,
            'folders' => []
        ]);
    }

    public function actionAdmin()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->getBodyParams());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
        }
        $files = FileHelper::findFiles('./content-pages', [
            'except' => [
                '*.jpg',
                '*.png',
                '*.jpeg'
            ]
        ]);
        $fileModel = [];
        foreach ($files as $file) {
            $fileModel[] = new FileModel($file);
        }
        return $this->render('admin', [
            'files' => $fileModel,
            'folders' => [],
            'model' => $model
        ]);
    }

    public function actionSearch()
    {
        $search = Yii::$app->request->getBodyParam('search');
        $files = FileHelper::findFiles('./content-pages', [
            'except' => [
                '*.jpg',
                '*.png',
                '*.jpeg'
            ]
        ]);
        $fileModel = [];
        foreach ($files as $file) {
            $fileModel[] = new FileModel($file);
        };

//        $fileModel = array_filter($fileModel, function($file) use($search){
//           return str_contains(...$file->content,$search) || str_contains($file->title,$search);
//        });
        return $this->render('index', [
            'files' => $fileModel,
            'folders' => []
        ]);
    }
}
