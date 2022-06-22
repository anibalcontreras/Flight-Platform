CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
rechazar_vuelo(v_id INT)

-- declaramos lo que retorna, en este caso un booleano
RETURNS void AS $$

-- declaramos las variables a utilizar
DECLARE


BEGIN


    UPDATE vuelos SET estado = 'rechazado' WHERE vuelo_id = v_id;


END

$$ language plpgsql