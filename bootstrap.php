<?php 
namespace zzzz0317\MediaEmbed;
use Flarum\Event\ConfigureFormatter;
use Illuminate\Events\Dispatcher;
use s9e\TextFormatter\Configurator\Bundles\MediaPack;

function subscribe(Dispatcher $events)
{
    $events->listen(
        ConfigureFormatter::class,
        function (ConfigureFormatter $event)
        {
            $event->configurator->Autoimage;
			
			$event->configurator->MediaEmbed->add(
				'youtube',
				[
					'host'    => ['youtube.com', 'youtu.be'],
					'extract' => [
						"!youtube\\.com/watch\\?v=(?'id'[-0-9A-Z_a-z]+)!",
						"!youtu\\.be/(?'id'[-0-9A-Z_a-z]+)!"
					],
					'iframe'  => [
						'width'  => 560,
						'height' => 315,
						'src'    => 'http://www.youtube.com/embed/{@id}'
					]
				]
			);
			
			$event->configurator->MediaEmbed->add(
            	'music163',
            	[
            		'host'    => 'music.163.com',
					'extract' => [
						'!music\\.163\\.com/#/(?\'mode\'song|album|playlist)\\?id=(?\'id\'\\d+)!',
						'!music\\.163\\.com/(?\'mode\'song|album|playlist)\\?id=(?\'id\'\\d+)!',
						'!music\\.163\\.com/(?\'mode\'song|album|playlist)/(?\'id\'\\d+)/\\?userid=(?\'uid\'\\d+)!',
					],
					'choose'  => [
            			'when' => [
            				[
            					'test' => '@mode = \'album\'',
            					'iframe'  => [
            						'width'  => 380,
            						'height' => 450,
            						'src'    => '//music.163.com/outchain/player?type=1&id={@id}&auto=0&height=450'
            					]
            				],
            				[
            					'test' => '@mode = \'song\'',
            					'iframe'  => [
            						'width'  => 380,
            						'height' => 86,
            						'src'    => '//music.163.com/outchain/player?type=2&id={@id}&auto=0&height=66'
            					]
            				]
            			],
            			'otherwise' => [
            				'iframe'  => [
            					'width'  => 380,
            					'height' => 450,
            					'src'    => '//music.163.com/outchain/player?type=0&id={@id}&auto=0&height=450'
            				]
            			]
            		]
               ]
            );
			
            $event->configurator->MediaEmbed->add(
                'bilibili',
                [   
                    'host'    => 'www.bilibili.com',
                    'extract' => [
                        "!www.bilibili.com/video/av(?'id'\\d+)/!",
                        "!www.bilibili.com/mobile/video/av(?'id'\\d+)\\.html!"
                    ],
                    'iframe'  => [
                        'width'  => 760,
                        'height' => 450,
                        'src'    => '/api/bilibili/js-iframe.php?aid={@id}'
                    ]
                ]
            );

            (new MediaPack)->configure($event->configurator);
        }
    );
};

return __NAMESPACE__ . '\\subscribe';
