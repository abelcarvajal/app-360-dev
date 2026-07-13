<?php

namespace Database\Seeders;

use App\Models\CategoriasCriterio;
use App\Models\ItemEvaluacion;
use App\Models\ItemNivel;
use Illuminate\Database\Seeder;

class ItemsEvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        $categoria = CategoriasCriterio::firstOrCreate(
            ['categoria' => 'Competencias Generales'],
            ['descripcion' => 'Competencias generales de todos los colaboradores']
        );

        $items = [
            [
                'nombre' => 'Atención al usuario',
                'descripcion' => 'Evalúa si reconoce estrategias útiles, para una atención oportuna y asertiva orientada a la satisfacción del cliente interno y externo',
                'niveles' => [
                    1 => 'Evidencia poco interés en reconocer las necesidades de los demás, procurando hacer el mínimo esfuerzo en brindar una solución oportuna.',
                    2 => 'Conoce las necesidades de los usuarios, sin embargo no brinda la importancia necesaria para establecer una atención oportuna y eficaz.',
                    3 => 'Reconoce las necesidades, pero se limita al cumplimiento de sus funciones, brinda una atención básica sin ser propositivo.',
                    4 => 'Logra conocer las necesidades de los demás y la mayoría de las veces brinda soluciones satisfactorias.',
                    5 => 'Reconoce y entiende las necesidades de los demás, brindando una atención efectiva en pro de establecer soluciones oportunas, con excelente actitud de servicio.',
                ],
            ],
            [
                'nombre' => 'Conocimiento de su labor',
                'descripcion' => 'Es consciente del cargo que desempeña y la manera en que lo desarrolla.',
                'niveles' => [
                    1 => 'Poco conocimiento, no demuestra experiencia en cuanto al desarrollo de su labor y no busca estrategias para mejorar su desempeño',
                    2 => 'Posee un regular nivel de formación y experiencia; requiere bastante ayuda para el desarrollo de su labor. Sin interés en nuevos aprendizajes.',
                    3 => 'Demuestra dominio y manejo de conceptos básicos y conocimiento de su labor, aunque en ocasiones necesita ayuda para el desarrollo de sus funciones',
                    4 => 'Posee conocimiento y experiencia en cuanto a su labor, permitiendo generar un desempeño adecuado de sus funciones.',
                    5 => 'Está bien informado y se actualiza sobre temas y procesos del cargo, demuestra un desempeño óptimo y aporta ideas objetivas para el cumplimiento de logros.',
                ],
            ],
            [
                'nombre' => 'Habilidades comunicativas y relaciones interpersonales',
                'descripcion' => 'Se refiere a la manera más asertiva de expresar las ideas y relacionarse con los demás',
                'niveles' => [
                    1 => 'Persona aislada y callada, no suele expresar sus ideas de manera clara y acepta todo lo que se le dice o por el contrario se manifiesta de forma arbitraria, tratando de imponerse ante los demás',
                    2 => 'Se le dificulta expresar sus opiniones, mostrándose inseguro, aunque se esfuerza por mantener buenas relaciones con los demás',
                    3 => 'Se expresa con facilidad, y responde asertivamente de manera verbal y expresiva, sin embargo le cuesta trabajo escuchar y acoger sugerencias.',
                    4 => 'Interactúa de forma espontánea con los demás, expresando sus ideas y opiniones de manera clara y efectiva.',
                    5 => 'Persona mediadora, sabe escuchar, acoge sugerencias, es propositiva y mantiene buenas relaciones con los demás fomentando el respeto, la confianza y el diálogo.',
                ],
            ],
            [
                'nombre' => 'Honestidad',
                'descripcion' => 'Persona que desarrolla con esmero y transparencia las actividades encargadas y siempre actúa con la verdad y la justicia.',
                'niveles' => [
                    1 => 'No es íntegro, ni transparente en las interacciones. Se pueden reconocer algunas actitudes y acciones que no son verídicas.',
                    2 => 'Consciente sobre algunos aspectos de su trabajo, sin embargo resta importancia a acciones que necesita mejorar. No es sincero.',
                    3 => 'Con conducta recta, honrada, que lleva a observar normas y compromisos. En algunos casos no es consecuente con los valores institucionales.',
                    4 => 'Piensa, se expresa y actúa de manera coherente y su fundamento son los valores morales',
                    5 => 'Respetuoso, íntegro y veraz en todo sentido, siendo una persona confiable y coherente entre lo que hace, lo que piensa y lo que dice.',
                ],
            ],
            [
                'nombre' => 'Manejo de la autoridad',
                'descripcion' => 'Hace referencia al reconocimiento y las actitudes frente situaciones y figuras de autoridad',
                'niveles' => [
                    1 => 'Se abstiene de llevar a cabo solicitudes realizadas por sus superiores, en ocasiones llega a tener actitudes defensivas y desafiantes frente a figuras de autoridad generando malestar y conflicto.',
                    2 => 'Cuestiona las instrucciones impartidas por su jefe inmediato, demorando a voluntad la ejecución de las mismas, mostrándose en oposición a las críticas constructivas. Poco tolerante.',
                    3 => 'Denota buena relaciones interpersonales con sus superiores, aunque ocasionalmente desconoce las instrucciones impartidas, puede que la relación con su jefe inmediato no sea óptima, sin embargo acata a cabalidad las solicitudes',
                    4 => 'Reconoce las figuras de autoridad de manera asertiva acatando normas e instrucciones para el cumplimiento de sus tareas asignadas. Es tolerante con las figuras de autoridad.',
                    5 => 'Atiende de manera eficaz las solicitudes realizadas por sus superiores respondiendo a éstas en los tiempos establecidos manteniendo una relación cordial y respetuosa aportando positivamente al cumplimiento de los logros',
                ],
            ],
            [
                'nombre' => 'Responsabilidad',
                'descripcion' => 'Cumplimiento de tareas y funciones, reconociendo la consecuencia de sus acciones y la manera de afrontarlas',
                'niveles' => [
                    1 => 'Desconoce las consecuencias de sus actos y no las asume, evitando confrontar los aspectos morales y éticos en su proceder. Puede asignar sus compromisos a otros',
                    2 => 'No dimensión a las consecuencias de sus actos aunque en ocasiones procura establecer estrategias de afrontamiento sin resultados positivos',
                    3 => 'Logra dimensionar las consecuencias positivas y negativas de sus actos sin embargo requiere de ayuda y orientación para establecer estrategias de afrontamiento',
                    4 => 'Reconoce y acepta las consecuencias de sus actos y la mayoría de las veces las asume logrando establecer estrategias de afrontamiento de manera positiva',
                    5 => 'Reconoce y asume las consecuencias de sus actos siendo objetivo y consciente de la importancia de su labor en el cumplimiento de los objetivos organizacionales.',
                ],
            ],
            [
                'nombre' => 'Trabajo en equipo',
                'descripcion' => 'Considera la habilidad para establecer dinámicas de apoyo, orientadas al cumplimiento de los objetivos organizacionales',
                'niveles' => [
                    1 => 'Se le dificulta el trabajo en equipo, es una persona individualista y no tiene en cuenta el aporte de los demás generando conflicto y malestar entre sus compañeros',
                    2 => 'Evita realizar labores con los demás colaboradores y en algunas ocasiones, busca su propio beneficio ejecutando actividades individuales',
                    3 => 'Establece relaciones positivas con sus compañeros, aunque se le dificulta en algunas ocasiones el cumplimiento de metas y objetivos grupales.',
                    4 => 'Realiza actividades grupales cumpliendo con los requerimientos solicitados para el trabajo en equipo, presenta buenas relaciones interpersonales con sus compañeros.',
                    5 => 'Dispuesto y propositivo en búsqueda del fortalecimiento de su grupo de trabajo, escucha y expresa sus ideas de manera oportuna en búsqueda del beneficio colectivo.',
                ],
            ],
            [
                'nombre' => 'Políticas de Protección y Cuidado (P.P.C)',
                'descripcion' => 'Se establecen las políticas de protección y cuidado - PPC para la ejecución de labores relacionadas con la atención integral a la población',
                'niveles' => [
                    1 => 'Desconoce las políticas de PPC y no muestra interés por informarse.',
                    2 => 'Su nivel de conocimiento es básico respecto al tema, sin embargo no lo aplica en sus funciones.',
                    3 => 'Muestra conocimiento acerca de las políticas de PPC sin embargo las aplica únicamente en algunos casos específicos.',
                    4 => 'Muestra conocimiento y experiencia acerca de las políticas de PPC y las aplica de manera oportuna',
                    5 => 'Tiene conocimiento y experiencia frente a las políticas de PPC, las aplica de manera efectiva, y se capacita de manera constante buscando ser propositivo.',
                ],
            ],
            [
                'nombre' => 'Objetivos y propósitos de la Fundación',
                'descripcion' => 'Hace referencia al conocimiento que tienen los colaboradores frente a las políticas de la Fundación',
                'niveles' => [
                    1 => 'Desconoce el propósito principal de la Fundación y no procura indagar acerca del mismo.',
                    2 => 'Reconoce algunos de los principales objetivos de la Fundación sin embargo no los tiene en cuenta en el ejercicio de su labor',
                    3 => 'Reconoce y aplica en algunos casos los objetivos y valores de la Fundación',
                    4 => 'Reconoce y aplica de manera oportuna los lineamientos establecidos por la Fundación para el ejercicio de su labor.',
                    5 => 'Reconoce, aplica y fomenta las políticas de la Fundación procurando mantener y trascender el buen nombre de la misma y su prestigio.',
                ],
            ],
            [
                'nombre' => 'Compromiso social',
                'descripcion' => 'Establece el sentido de pertenencia y respeto que se tiene socialmente frente a las realidades del entorno.',
                'niveles' => [
                    1 => 'Se muestra indiferente frente a las múltiples realidades del entorno.',
                    2 => 'Muestra poca sensibilidad frente a algunas situaciones del entorno',
                    3 => 'Reconoce las realidades de su entorno, sin embargo no toma acciones frente a las mismas.',
                    4 => 'Muestra interés por las diferentes realidades de su entorno buscando tomar acciones positivas.',
                    5 => 'Reconoce, actúa y brinda soluciones efectivas buscando transformar el entorno social.',
                ],
            ],
        ];

        foreach ($items as $itemData) {
            $item = ItemEvaluacion::firstOrCreate(
                ['nombre' => $itemData['nombre'], 'id_categorias_criterios' => $categoria->id],
                ['descripcion' => $itemData['descripcion'], 'activo' => true]
            );

            foreach ($itemData['niveles'] as $nivel => $descripcion) {
                ItemNivel::firstOrCreate(
                    ['item_evaluacion_id' => $item->id, 'nivel' => $nivel],
                    ['descripcion' => $descripcion]
                );
            }
        }
    }
}
