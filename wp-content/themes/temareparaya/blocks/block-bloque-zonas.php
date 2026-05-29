<?php
/**
 * Plantilla del bloque de zonas de ReparaYa (Versión API Remota)
 */

$url_del_json = 'https://fp064.techlab.uoc.edu/~uocx8/producto3/public/index.php/api/servicios/zonas'; 

// Intentamos hacer la petición remota a la URL usando WordPress
$respuesta = wp_remote_get( $url_del_json );

// Creamos la red de seguridad por si la URL falla
$json_data = '';

if ( ! is_wp_error( $respuesta ) && wp_remote_retrieve_response_code( $respuesta ) === 200 ) {
    $json_data = wp_remote_retrieve_body( $respuesta );
} else {
    $json_data = '{"ok":true,"data":[{"zona":"Centro","total_servicios":4,"porcentaje":41},{"zona":"Eixample","total_servicios":5,"porcentaje":50},{"zona":"Gracia","total_servicios":1,"porcentaje":10},{"zona":"Sant Marti","total_servicios":0,"porcentaje":0},{"zona":"Horta","total_servicios":0,"porcentaje":0}]}';
}

$resultado = json_decode( $json_data, true );

if ( $resultado && isset( $resultado['ok'] ) && $resultado['ok'] === true ) {
    
    usort( $resultado['data'], function( $a, $b ) {
        return $b['total_servicios'] <=> $a['total_servicios'];
    });
    
}

if ( $resultado && isset( $resultado['ok'] ) && $resultado['ok'] === true ) : ?>

    <div class="contenedor-zonas" style="background: none; padding:20px; border-radius:8px; font-family:sans-serif; max-width:600px; margin:auto;">
        <h2 style="color:#333; font-size:1.4rem; margin-bottom:20px;">Distribución de Servicios por Zonas (API en vivo)</h2>
        
        <div class="grid-zonas" style="display:flex; flex-direction:column; gap:15px;">
            <?php foreach ( $resultado['data'] as $item ) : ?>
                <div class="tarjeta-zona" style="background:#f4f9f0; padding:12px; border-radius:6px; border-left:5px solid #437119;">
                    
                    <div class="info-tarjeta" style="display:flex; justify-content:space-between; margin-bottom:6px; font-size:0.95rem;">
                        <span class="nombre-zona" style="font-weight:bold; color:#2c3e50;"><?php echo esc_html( $item['zona'] ); ?></span>
                        <span class="servicios-zona" style="color:#666;"><strong><?php echo esc_html( $item['total_servicios'] ); ?></strong> servicios / <strong><?php echo esc_html( $item['porcentaje'] ); ?></strong>%</span>
                    </div>
                    
                    <div class="barra-progreso-bg" style="background:#e0e0e0; border-radius:10px; height:16px; width:100%; overflow:hidden;">
                        <div class="barra-progreso-relleno" style="background:#437119; height:100%; width:<?php echo esc_attr( $item['porcentaje'] ); ?>%; display:flex; align-items:center; justify-content:flex-end;">
                            <span class="porcentaje-texto" style="color:#fff; font-size:0.7rem; font-weight:bold; padding-right:8px;"></span>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else : ?>
    <div style="padding: 20px; background: #fff3cd; color: #856404; border-radius: 6px;">
        ⚠️ Error: El formato de los datos recibidos no es válido.
    </div>
<?php endif; ?>