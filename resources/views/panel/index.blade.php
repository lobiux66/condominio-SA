@extends('plantilla')

@section('title', 'Panel principal')

@section('content')
<style>
    .sa-dashboard { --sa-ink:#17233b; --sa-muted:#68758c; color:var(--sa-ink); padding:1.5rem clamp(1rem,2.4vw,2.25rem) 2.5rem; background:#f5f7fb; min-height:calc(100vh - 120px); }
    .sa-hero { background:linear-gradient(125deg,#12233f 0%,#1c4670 65%,#247b82 100%); color:#fff; border-radius:22px; padding:clamp(1.4rem,3vw,2.4rem); position:relative; overflow:hidden; box-shadow:0 14px 38px rgba(25,54,91,.14); }
    .sa-hero:after { content:""; position:absolute; width:270px;height:270px;border:1px solid #ffffff20;border-radius:50%;right:-65px;top:-100px;box-shadow:0 0 0 34px #ffffff08,0 0 0 68px #ffffff06;pointer-events:none; }
    .sa-eyebrow { text-transform:uppercase;letter-spacing:.13em;font-size:.72rem;font-weight:800;color:#b8d9ec; }
    .sa-hero h1 { font-weight:800;letter-spacing:-.035em;font-size:clamp(1.65rem,3vw,2.4rem);margin:.55rem 0 .6rem; }
    .sa-hero p { color:#d9e7f3;max-width:620px;margin:0; }
    .sa-pill { display:inline-flex;align-items:center;gap:.45rem;border:1px solid #ffffff38;background:#ffffff12;border-radius:999px;padding:.5rem .8rem;font-size:.78rem;font-weight:600; }
    .sa-section-title { font-size:1.1rem;font-weight:800;letter-spacing:-.02em;margin:1.9rem 0 .25rem; }
    .sa-section-subtitle { color:var(--sa-muted);font-size:.9rem;margin-bottom:1rem; }
    .sa-search { max-width:340px; position:relative; }
    .sa-search input { border-radius:12px;padding:.75rem 1rem .75rem 2.55rem;border:1px solid #e1e7f0;background:#fff;box-shadow:0 2px 8px #152b4b08; }
    .sa-search i { position:absolute;left:.95rem;top:50%;transform:translateY(-50%);color:#8190a6; }
    .sa-module { height:100%;display:flex;flex-direction:column;background:#fff;border:1px solid #e5eaf2;border-radius:16px;padding:1.15rem;text-decoration:none;color:var(--sa-ink);transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;box-shadow:0 3px 12px #182d4a05; }
    .sa-module:hover { transform:translateY(-3px);border-color:#c4d7e8;box-shadow:0 12px 26px #182d4a10;color:var(--sa-ink); }
    .sa-module-icon { width:44px;height:44px;display:grid;place-items:center;border-radius:13px;font-size:1.1rem;margin-bottom:1rem; }
    .sa-blue {background:#e9f2ff;color:#2c69b2}.sa-green {background:#e5f7f0;color:#19815e}.sa-orange {background:#fff0df;color:#b66b17}.sa-violet {background:#f0eaff;color:#7554b5}.sa-cyan {background:#e1f7fa;color:#1b8291}.sa-rose {background:#ffe9ed;color:#b94e68}
    .sa-module h3 {font-size:1rem;font-weight:800;margin:0 0 .4rem; }
    .sa-module p {font-size:.83rem;color:var(--sa-muted);line-height:1.5;margin:0 0 1.1rem; }
    .sa-module .sa-link { margin-top:auto;font-size:.8rem;font-weight:800;color:#27649a;display:flex;justify-content:space-between;align-items:center; }
    .sa-quick {background:#fff;border:1px solid #e5eaf2;border-radius:16px;padding:1.1rem;height:100%;}
    .sa-quick a {display:flex;align-items:center;gap:.7rem;padding:.7rem .15rem;text-decoration:none;color:#26364e;font-weight:650;font-size:.88rem;border-bottom:1px solid #eef1f6;}
    .sa-quick a:last-child {border-bottom:0}.sa-quick a:hover{color:#246a9e}.sa-quick i{width:18px;text-align:center;color:#5c7d9d}
    .sa-empty {display:none;padding:1.5rem;text-align:center;color:var(--sa-muted);background:#fff;border:1px dashed #ccd5e2;border-radius:14px}
    @media(max-width:575px){.sa-dashboard{padding:1rem .75rem 2rem}.sa-hero{border-radius:16px}.sa-hero:after{right:-180px}.sa-search{max-width:none;width:100%}}
</style>

<div class="sa-dashboard">
    <section class="sa-hero">
        <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-4 position-relative" style="z-index:1">
            <div>
                <div class="sa-eyebrow">Condominio SA · Gestión centralizada</div>
                <h1>Todo el condominio,<br class="d-none d-sm-block"> bajo control.</h1>
                <p>Administra personal, cobros, mantenimiento, accesos y comunicaciones desde un solo lugar.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="sa-pill"><i class="fa-solid fa-shield-halved"></i> Panel administrativo</span>
                <span class="sa-pill"><i class="fa-solid fa-mobile-screen-button"></i> Adaptable a móvil</span>
            </div>
        </div>
    </section>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
        <div>
            <h2 class="sa-section-title">Módulos de gestión</h2>
            <p class="sa-section-subtitle mb-0">Accede a las funciones principales del sistema.</p>
        </div>
        <div class="sa-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input id="saModuleSearch" class="form-control" type="search" placeholder="Buscar un módulo..." aria-label="Buscar módulos">
        </div>
    </div>

    <div class="row g-3 mt-1" id="saModuleGrid">
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="usuarios empleados personal roles permisos accesos">
            <a href="{{ route('users.index') }}" class="sa-module">
                <span class="sa-module-icon sa-blue"><i class="fa-solid fa-users-gear"></i></span>
                <h3>Usuarios y personal</h3><p>Administra cuentas de acceso, empleados, roles y permisos del equipo.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="residentes unidades propiedades viviendas personas">
            <a href="{{ route('residentes.index') }}" class="sa-module">
                <span class="sa-module-icon sa-green"><i class="fa-solid fa-building-user"></i></span>
                <h3>Residentes y unidades</h3><p>Organiza residentes, propiedades y su relación con las unidades habitacionales.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="cuotas pagos multas finanzas dinero cobros">
            <a href="{{ route('cuotas.index') }}" class="sa-module">
                <span class="sa-module-icon sa-orange"><i class="fa-solid fa-wallet"></i></span>
                <h3>Cuotas y pagos</h3><p>Consulta cuotas, registra pagos y da seguimiento a multas pendientes.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="visitas guardia seguridad entradas salidas">
            <a href="{{ route('visitas.index') }}" class="sa-module">
                <span class="sa-module-icon sa-violet"><i class="fa-solid fa-door-open"></i></span>
                <h3>Control de visitas</h3><p>Registra visitantes y administra el control de entradas y salidas.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="reservas areas comunes salon cancha piscina espacios">
            <a href="{{ route('reservas.index') }}" class="sa-module">
                <span class="sa-module-icon sa-cyan"><i class="fa-solid fa-calendar-check"></i></span>
                <h3>Reservas y áreas comunes</h3><p>Organiza espacios compartidos y consulta las reservas registradas.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="mantenimiento reparaciones tareas proveedores">
            <a href="{{ route('mantenimientos.index') }}" class="sa-module">
                <span class="sa-module-icon sa-orange"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                <h3>Mantenimiento</h3><p>Da seguimiento a trabajos, tareas y necesidades de las instalaciones.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="comunicados anuncios noticias avisos">
            <a href="{{ route('comunicados.index') }}" class="sa-module">
                <span class="sa-module-icon sa-blue"><i class="fa-solid fa-bullhorn"></i></span>
                <h3>Comunicados</h3><p>Publica avisos y mantén organizadas las comunicaciones internas.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="informes reportes estadisticas pagos administración">
            <a href="{{ route('informes.administrativo') }}" class="sa-module">
                <span class="sa-module-icon sa-violet"><i class="fa-solid fa-chart-line"></i></span>
                <h3>Informes y reportes</h3><p>Accede a informes administrativos y revisa la información de gestión.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="incidencias reclamos quejas problemas">
            <a href="{{ route('incidencias.index') }}" class="sa-module">
                <span class="sa-module-icon sa-rose"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <h3>Incidencias y reclamos</h3><p>Registra situaciones que requieren atención y seguimiento administrativo.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="eventos actividades calendario">
            <a href="{{ route('eventos.index') }}" class="sa-module">
                <span class="sa-module-icon sa-green"><i class="fa-solid fa-calendar-days"></i></span>
                <h3>Eventos</h3><p>Organiza actividades y consulta los eventos registrados en el condominio.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="empresas externas contratos proveedores">
            <a href="{{ route('empresas.index') }}" class="sa-module">
                <span class="sa-module-icon sa-cyan"><i class="fa-solid fa-handshake"></i></span>
                <h3>Proveedores</h3><p>Organiza empresas externas y servicios contratados.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 sa-module-wrap" data-search="bitacora auditoria historial actividad">
            <a href="{{ route('bitacora.index') }}" class="sa-module">
                <span class="sa-module-icon sa-blue"><i class="fa-solid fa-clipboard-list"></i></span>
                <h3>Bitácora del sistema</h3><p>Consulta el historial de actividad disponible para auditoría.</p>
                <span class="sa-link">Abrir módulo <i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
    </div>
    <div id="saNoResults" class="sa-empty mt-3">No encontramos módulos con ese nombre. Prueba otra búsqueda.</div>

    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-7">
            <div class="sa-quick">
                <h2 class="h6 fw-bold mb-1">Accesos rápidos</h2>
                <p class="small text-secondary mb-2">Atajos para tareas habituales.</p>
                <a href="{{ route('users.create') }}"><i class="fa-solid fa-user-plus"></i> Crear usuario del sistema <i class="fa-solid fa-arrow-up-right-from-square ms-auto small"></i></a>
                <a href="{{ route('empleados.create') }}"><i class="fa-solid fa-id-card"></i> Registrar empleado <i class="fa-solid fa-arrow-up-right-from-square ms-auto small"></i></a>
                <a href="{{ route('comunicados.create') }}"><i class="fa-solid fa-message"></i> Crear comunicado <i class="fa-solid fa-arrow-up-right-from-square ms-auto small"></i></a>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="sa-quick">
                <h2 class="h6 fw-bold mb-2">Pensado para la administración</h2>
                <p class="small text-secondary mb-2">Esta primera versión reúne los accesos más importantes en una pantalla sencilla. Los módulos conservan sus formularios y rutas del sistema existente.</p>
                <div class="d-flex align-items-start gap-2 small text-secondary mt-3"><i class="fa-solid fa-circle-check text-success mt-1"></i><span>Interfaz adaptable a computadora, tablet y móvil.</span></div>
                <div class="d-flex align-items-start gap-2 small text-secondary mt-2"><i class="fa-solid fa-circle-check text-success mt-1"></i><span>Accesos directos a funciones de gestión.</span></div>
                <div class="d-flex align-items-start gap-2 small text-secondary mt-2"><i class="fa-solid fa-circle-info text-primary mt-1"></i><span>Antes de la demostración se deben validar los flujos y los permisos con datos de prueba.</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('saModuleSearch');
    const modules = Array.from(document.querySelectorAll('.sa-module-wrap'));
    const empty = document.getElementById('saNoResults');
    if (!search) return;
    search.addEventListener('input', function () {
        const term = this.value.trim().toLocaleLowerCase('es');
        let visible = 0;
        modules.forEach(function (module) {
            const text = (module.innerText + ' ' + (module.dataset.search || '')).toLocaleLowerCase('es');
            const match = text.includes(term);
            module.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        empty.style.display = visible ? 'none' : 'block';
    });
});
</script>
@endpush
