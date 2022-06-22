CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
aceptar_vuelo(v_id INT)

-- declaramos lo que retorna, en este caso un booleano
RETURNS void AS $$

-- declaramos las variables a utilizar
DECLARE


BEGIN


    UPDATE vuelos SET estado = 'aceptado' WHERE vuelo_id = v_id;


END

$$ language plpgsql