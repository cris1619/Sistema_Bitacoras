<?php

use App\Models\EstadoAprendiz;
use App\Models\Ficha;
use App\Models\ProgramaFormacion;
use App\Models\VinculoFormativo;

it('creates an aprendiz with the form data', function () {
    $programa = ProgramaFormacion::create([
        'codigo_programa' => 'P001',
        'nombre_programa' => 'Programación',
        'nivel_formacion' => 'Técnico',
    ]);

    $ficha = Ficha::create([
        'numero_ficha' => '2571140',
        'programa_id' => $programa->id,
    ]);

    EstadoAprendiz::create(['nombre_estado' => 'Activo']);
    VinculoFormativo::create(['nombre_vinculo' => 'Contrato']);

    $response = $this->post('/aprendices', [
        'ficha_id' => $ficha->id,
        'estado_id' => 1,
        'vinculo_id' => 1,
        'tipo_documento' => 'CC',
        'documento_identidad' => '1234567890',
        'nombres' => 'Juan',
        'apellidos' => 'Pérez',
        'correo_electronico' => 'juan@example.com',
        'telefono' => '3000000000',
        'empresa' => 'Empresa Test',
        'jefe_inmediato' => 'Jefe Test',
        'correo_empresa' => 'empresa@test.com',
        'telefono_empresa' => '3000000001',
        'modalidad_practica' => 'Empresa',
        'lugar_practica' => null,
        'supervisor_practica' => null,
        'correo_supervisor' => null,
        'telefono_supervisor' => null,
        'fecha_inicio_practica' => null,
        'fecha_fin_practica' => null,
        'detalles_contrato' => 'Contrato válido',
    ]);

    $response->assertRedirect(route('aprendices.index'));
    $this->assertDatabaseHas('aprendices', [
        'documento_identidad' => '1234567890',
        'nombres' => 'Juan',
    ]);
});
