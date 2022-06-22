CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_usuarios()

-- declaramos lo que retorna, en este caso un booleano
RETURNS void AS $$

-- declaramos las variables a utilizar
DECLARE

tupla RECORD;
pasajero RECORD;

BEGIN

    IF NOT EXISTS (SELECT * FROM usuarios) THEN

        INSERT INTO usuarios values('dgac', 'admin', 0);

        FOR tupla IN (SELECT * FROM dblink('dbname=grupo105e3 user=grupo105 password=anibalproyectoroberto port=5432','SELECT * FROM companias') AS f(codigo_compania varchar, nombre_compania varchar))

        LOOP

            INSERT INTO usuarios values(tupla.codigo_compania, substr(md5(random()::text), 0, 10), 1);

        END LOOP;

        FOR pasajero IN (SELECT * FROM dblink('dbname=grupo105e3 user=grupo105 password=anibalproyectoroberto port=5432','SELECT * FROM pasajeros WHERE pasajeros IS NOT NULL') AS f(pasaporte_pasajero varchar, nombre_pasajero varchar, fecha_nacimiento_pasajero varchar, nacionalidad_pasajero varchar))
        
        LOOP

            INSERT INTO usuarios values(pasajero.pasaporte_pasajero, concat(pasajero.nombre_pasajero, substr(md5(random()::text), 0, 4), pasajero.pasaporte_pasajero), 2);

        END LOOP;

        UPDATE usuarios SET "contrasena"=replace("contrasena", ' ', '');

        ALTER TABLE usuarios ADD COLUMN id SERIAL PRIMARY KEY;
    
    END IF;

END

$$ language plpgsql