SELECT locations.name, locations.description, locations.image, locations.loc_type, address.address, address.ZIP, address.city, address.state, restaurants.phone, restaurants.web, rest_type.rest_type, 
FROM locations
INNER JOIN address ON locations.address = address.address_id,
INNER JOIN restaurants ON locations.loc_id = restaurants.loc_id,
INNER JOIN rest_type ON restaurants.rest_type = rest_type.rest_type_id
INNER JOIN places ON locations.loc_id = places.loc_id,
INNER JOIN place_type ON places.place_type = place_type.place_type_id,
INNER JOIN concerts ON locations.loc_id = concerts.loc_id


