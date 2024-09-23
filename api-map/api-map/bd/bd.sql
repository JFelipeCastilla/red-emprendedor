CREATE TABLE department (
    id INT AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    description TEXT,
    entrepreneurs INT(5),
    capital VARCHAR(50) NOT NULL,
    population INT(10),
    gdp DECIMAL(15, 2),  -- PIB en dólares con dos decimales
    unemployment_rate DECIMAL(4, 2),  -- Tasa de desempleo en porcentaje (máximo 99.99%)
    PRIMARY KEY (id)
);
INSERT INTO department (name, description, entrepreneurs, capital, population, gdp, unemployment_rate)
VALUES
('Bogotá', 'La capital de Colombia, situada en el altiplano andino, es una ciudad vibrante y multicultural. Con una población diversa y un importante centro económico, Bogotá es conocida por su rica oferta cultural, instituciones educativas y eventos artísticos, además de ser un núcleo político y administrativo del país.', 40000, 'Bogotá', 8000000, 90000000000.00, 9.00),
('Antioquia', 'Una región montañosa en el noroeste de Colombia, famosa por su cultura innovadora y la ciudad de Medellín, que ha sido reconocida por su transformación social y urbanística. Es un centro industrial clave del país.', 20000, 'Medellín', 6500000, 50000000000.00, 10.50),
('Cundinamarca', 'Región que rodea la capital de Colombia, Bogotá, y que incluye áreas rurales con rica tradición agrícola. Es conocida por su diversidad cultural y su importancia económica en el país.', 30000, 'Bogotá', 11100000, 70000000000.00, 8.20),
('Valle del Cauca', 'Una región del suroeste conocida por su producción de azúcar y su vibrante ciudad de Cali, famosa por su salsa y su diversidad cultural. Es un importante centro comercial y agrícola.', 15000, 'Cali', 4600000, 40000000000.00, 9.80),
('Atlántico', 'Departamento costero del norte de Colombia, con una rica herencia cultural y un puerto importante en Barranquilla, que es conocido por su Carnaval y su industria.', 12000, 'Barranquilla', 2500000, 25000000000.00, 11.50),
('Bolívar', 'Conocido por su patrimonio histórico y cultural, especialmente en Cartagena, que es un destino turístico popular con su arquitectura colonial y sus festivales culturales.', 8000, 'Cartagena', 2200000, 23000000000.00, 12.30),
('Santander', 'Una región montañosa con importantes recursos naturales y una economía diversificada. Bucaramanga, su capital, es conocida como la "Ciudad Bonita" por su calidad de vida.', 14000, 'Bucaramanga', 2300000, 27000000000.00, 7.60),
('Nariño', 'Ubicado en el suroeste, cerca de la frontera con Ecuador, Nariño es conocido por su biodiversidad y su producción agrícola, así como por su cultura indígena vibrante.', 7000, 'Pasto', 1800000, 18000000000.00, 12.00),
('Boyacá', 'Una región rica en cultura e historia, con paisajes montañosos y una tradición agrícola fuerte. Tunja, su capital, es un centro de patrimonio histórico.', 10000, 'Tunja', 1300000, 20000000000.00, 6.90),
('Córdoba', 'Ubicado en la costa norte, conocido por su producción agrícola y ganadera. Montería es un importante centro económico de la región con su riqueza cultural.', 9000, 'Montería', 1800000, 21000000000.00, 10.20),
('Magdalena', 'Conocido por la ciudad de Santa Marta y su costa caribeña, este departamento es un importante destino turístico con su Parque Tayrona y su biodiversidad.', 5000, 'Santa Marta', 1300000, 15000000000.00, 13.80),
-- Región Caribe
('La Guajira', 'Región conocida por sus paisajes desérticos y cultura indígena, habitada en gran parte por la comunidad Wayuu, famosa por su artesanía y tradiciones.', 4000, 'Riohacha', 1000000, 12000000000.00, 14.50),
('Cesar', 'Región agrícola con importantes yacimientos de carbón, con una economía diversificada que incluye la ganadería y la minería. Valledupar es famosa por su música vallenata.', 5000, 'Valledupar', 1200000, 13000000000.00, 13.00),
('Sucre', 'Región ganadera y agrícola en la costa Caribe, conocida por su producción de caña de azúcar y su rica herencia cultural, especialmente en Sincelejo.', 4000, 'Sincelejo', 900000, 8000000000.00, 12.80),
-- Región Pacífico
('Chocó', 'Región selvática rica en biodiversidad y recursos naturales, conocida por su cultura afrocolombiana y su música, así como por su riqueza en oro y recursos hídricos.', 2000, 'Quibdó', 500000, 4000000000.00, 15.00),
-- Región Andina
('Caldas', 'Una región cafetera famosa por sus montañas y paisajes, además de ser un importante productor de café de alta calidad. Manizales es reconocida por su Feria del Café.', 8000, 'Manizales', 1000000, 12000000000.00, 9.50),
('Risaralda', 'Conocido por su producción de café y biodiversidad, con un clima templado que favorece la agricultura. Pereira es un importante centro comercial de la región.', 7000, 'Pereira', 950000, 11000000000.00, 9.20),
('Quindío', 'El corazón de la región cafetera de Colombia, famosa por sus paisajes y su producción de café, además de ser un destino turístico popular por el Parque Nacional del Café.', 6000, 'Armenia', 600000, 7000000000.00, 10.80),
('Norte de Santander', 'Región fronteriza con Venezuela, conocida por su industria y comercio, así como por su diversidad cultural y su rica historia. Cúcuta es un centro económico clave.', 6000, 'Cúcuta', 1500000, 13000000000.00, 14.00),
('Huila', 'Región productora de café y cacao en el suroeste de Colombia, conocida por sus paisajes naturales y su clima cálido. Neiva es la capital del departamento.', 5000, 'Neiva', 1100000, 10000000000.00, 9.00),
('Tolima', 'Región agrícola productora de arroz y algodón, famosa por su riqueza cultural y su música. Ibagué es un importante centro cultural y económico.', 7000, 'Ibagué', 1400000, 11000000000.00, 10.20),
-- Región Orinoquía
('Arauca', 'Región fronteriza rica en petróleo y ganadería, con un clima cálido y una economía basada en la agricultura y la explotación de recursos naturales.', 2000, 'Arauca', 300000, 6000000000.00, 12.00),
('Casanare', 'Importante región petrolera y ganadera, conocida por sus grandes llanuras y su biodiversidad, Yopal es la capital y un centro de comercio importante.', 3000, 'Yopal', 450000, 12000000000.00, 7.80),
('Meta', 'Conocido por su producción de petróleo y agricultura, además de ser un destino turístico por sus paisajes llaneros. Villavicencio es la puerta de entrada a los Llanos Orientales.', 4000, 'Villavicencio', 1100000, 15000000000.00, 9.50),
('Vichada', 'Región con baja densidad poblacional, rica en recursos naturales y biodiversidad. Puerto Carreño es un centro de comercio importante para la región.', 1000, 'Puerto Carreño', 100000, 3000000000.00, 14.20),
-- Región Amazonía
('Caquetá', 'Región selvática dedicada a la agricultura y ganadería, con una rica biodiversidad y paisajes naturales impresionantes. Florencia es la capital del departamento.', 2000, 'Florencia', 500000, 5000000000.00, 13.50),
('Putumayo', 'Conocido por su biodiversidad y producción de petróleo, además de su cultura indígena. Mocoa es un centro importante para el ecoturismo en la región.', 2000, 'Mocoa', 350000, 4000000000.00, 12.80),
('Guainía', 'Región selvática con baja densidad poblacional, rica en recursos naturales y biodiversidad. Inírida es un centro cultural de la región.', 500, 'Inírida', 100000, 2000000000.00, 15.00),
('Guaviare', 'Región con áreas selváticas y actividades agrícolas, conocida por su biodiversidad y cultura indígena. San José del Guaviare es su capital.', 1000, 'San José del Guaviare', 200000, 2500000000.00, 13.00),
('Vaupés', 'Región selvática con poca infraestructura y baja densidad poblacional, rica en cultura indígena. Mitú es un importante centro cultural de la región.', 500, 'Mitú', 40000, 1000000000.00, 16.50),
('Amazonas', 'Región selvática en la frontera con Brasil y Perú, famosa por su biodiversidad y recursos naturales. Leticia es la capital y un destino turístico popular.', 500, 'Leticia', 80000, 1500000000.00, 15.80),
-- Región Insular
('San Andrés y Providencia', 'Archipiélago en el mar Caribe, conocido por su turismo y belleza natural, con playas de arena blanca y aguas cristalinas. San Andrés es el centro turístico más importante.', 3000, 'San Andrés', 80000, 1200000000.00, 11.50);