<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {

        if($role && Auth::user()->{'role_' . $role} !== 1) {
            return response(view( 'dashboard.not-allowed')->render());
        }

        Event::listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $menu = [
                'admin' => [
                    'admin_users' => [
                        'text'    => 'Użytkownicy',
                        'icon' => 'fas fa-fw fa-user',
                        'submenu' => [
                            [
                                'text' => 'Lista użytkowników',
                                'icon' => 'fas fa-fw fa-user',
                                'url'  => route('users.index'),
                            ],
                            [
                                'text' => 'Dodaj użytkownika',
                                'icon' => 'fas fa-user-plus',
                                'url'  => route('users.create'),
                            ],
                        ],
                    ],
                    'admin_students' => [
                        'text'    => 'Uczniowie',
                        'icon' => 'fas fa-user-graduate',
                        'submenu' => [
                            [
                                'text' => 'Lista uczniów',
                                'icon' => 'fas fa-fw fa-user',
                                'url'  => route('students.index'),
                            ],
                            [
                                'text' => 'Dodaj ucznia',
                                'icon' => 'fas fa-user-plus',
                                'url'  => route('students.create'),
                            ],
                        ],
                    ],

                    'admin_teachers' => [
                        'text'    => 'Nauczyciele',
                        'icon' => 'fas fa-fw fa-user',
                        'submenu' => [
                            [
                                'text' => 'Lista nauczycieli',
                                'icon' => 'fas fa-fw fa-user',
                                'url'  => route('teachers.index'),
                            ],
                            [
                                'text' => 'Dodaj nauczyciela',
                                'icon' => 'fas fa-user-plus',
                                'url'  => route('teachers.create'),
                            ],
                        ],
                    ],
                    'admin_classes' => [
                        'text'    => 'Klasy',
                        'icon' => 'fas fa-door-open',
                        'submenu' => [
                            [
                                'text' => 'Lista klas',
                                'icon' => 'fas fa-door-open',
                                'url'  => route('classes.index'),
                            ],
                            [
                                'text' => 'Dodaj klasę',
                                'icon' => 'fas fa-door-closed',
                                'url'  => route('classes.create'),
                            ],
                        ],
                    ],
                    'admin_grades' => [
                        'text'    => 'Oceny',
                        'icon' => 'fas fa-book-open',
                        'submenu' => [
                            [
                                'text' => 'Lista ocen',
                                'icon' => 'fas fa-book-reader',
                                'url'  => route('grades.index'),
                            ],
                            [
                                'text' => 'Dodaj ocenę',
                                'icon' => 'fas fa-pencil-alt',
                                'url'  => route('grades.create'),
                            ],
                        ],
                    ],
                    'admin_notes' => [
                        'text'    => 'Uwagi',
                        'icon' => 'fas fa-sticky-note',
                        'submenu' => [
                            [
                                'text' => 'Lista uwag',
                                'icon' => 'fas fa-clipboard',
                                'url'  => route('notes.index'),
                            ],
                            [
                                'text' => 'Dodaj uwagę',
                                'icon' => 'fas fa-pencil-ruler',
                                'url'  => route('notes.create'),
                            ],
                        ],
                    ]
                ],
                'teacher' => [

                ],
                'student' => [
                    'my_grades' => [
                        'text'    => 'Moje oceny',
                        'icon' => 'fas fa-book-open',
                        'submenu' => [
                            [
                                'text' => 'Lista ocen',
                                'icon' => 'fas fa-book-reader',
                                'url'  => route('grades.student'),
                            ],
                        ],
                    ],
                    'my_notes' => [
                        'text' => 'Moje uwagi',
                        'icon' => 'fas fa-sticky-note',
                        'submenu' => [
                            [
                                'text' => 'Lista uwag',
                                'icon' => 'fas fa-clipboard',
                                'url' => route('notes.student'),
                            ],
                        ],
                    ]
                ],

                'parent' => [

                ],
                'director' => [

                ],
                'all' => [
                    ['header' => 'USTAWIENIA KONTA'],
                    [
                        'text' => 'Profil',
                        'url'  => route('users.profile'),
                        'icon' => 'fas fa-fw fa-user',
                    ]
                ]
            ];

            $menu_to_load = [];

            foreach($menu as $role => $arr) {
                if($role === 'all') {
                    $menu_to_load = array_merge($menu_to_load, $arr);
                    continue;
                }
                if(Auth::user()->{'role_' . $role} === 1) {
                    $menu_to_load = array_merge($menu_to_load, $arr);
                }
            }

            foreach($menu_to_load as $menu) {
                $event->menu->add($menu);
            }
        });

        return $next($request);
    }
}
