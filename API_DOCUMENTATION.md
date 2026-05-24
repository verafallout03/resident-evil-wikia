# Resident Evil Wikia — API Documentation

Base URL: `http://localhost/api`  
All responses are JSON. All write endpoints require a Bearer token (Sanctum).

---

## Authentication

### Register
`POST /api/auth/register`

**Body (JSON)**
```json
{
  "name": "Leon Kennedy",
  "email": "leon@raccoon.gov",
  "password": "secret123",
  "password_confirmation": "secret123"
}
```

**Response `201`**
```json
{
  "user": { "id": 1, "name": "Leon Kennedy", "email": "leon@raccoon.gov", "role": "editor" },
  "token": "1|abcdefg..."
}
```

---

### Login
`POST /api/auth/login`

**Body (JSON)**
```json
{
  "email": "leon@raccoon.gov",
  "password": "secret123"
}
```

**Response `200`**
```json
{
  "user": { "id": 1, "name": "Leon Kennedy", "email": "leon@raccoon.gov", "role": "editor" },
  "token": "1|abcdefg..."
}
```

**Response `422`** — credentials mismatch
```json
{
  "message": "Las credenciales no coinciden con nuestros registros.",
  "errors": { "email": ["Las credenciales no coinciden con nuestros registros."] }
}
```

---

### Logout
`POST /api/auth/logout`  
**Requires:** `Authorization: Bearer {token}`

**Response `200`**
```json
{ "message": "Sesión cerrada correctamente." }
```

---

## Games

### List Games
`GET /api/games`  
Public endpoint. Returns paginated list in random order.

**Query params**
| Param | Default | Description |
|-------|---------|-------------|
| `per_page` | 6 | Items per page |

**Response `200`**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Resident Evil 2",
      "slug": "resident-evil-2",
      "release_year": 1998,
      "platform": "PlayStation",
      "developer": "Capcom",
      "cover_image": null,
      "synopsis": "...",
      "canon": "main",
      "is_published": true,
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ],
  "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
  "meta": { "current_page": 1, "per_page": 6, "total": 20, ... }
}
```

---

### Get Game
`GET /api/games/{slug}`  
Public endpoint.

**Response `200`** — single game object wrapped in `{ "data": {} }`  
**Response `404`** — game not found

---

### Create Game
`POST /api/games`  
**Requires:** `Authorization: Bearer {token}`

**Body (JSON)**
```json
{
  "title": "Resident Evil 4",
  "slug": "resident-evil-4",
  "release_year": 2005,
  "platform": "GameCube",
  "developer": "Capcom",
  "synopsis": "Leon is sent to rescue the president's daughter.",
  "canon": "main",
  "is_published": true
}
```

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `title` | string | yes | max 255 |
| `slug` | string | yes | unique, max 255 |
| `release_year` | integer | yes | 1996–2100 |
| `platform` | string | yes | max 255 |
| `developer` | string | no | default: Capcom |
| `cover_image` | string | no | URL or path |
| `synopsis` | string | no | |
| `canon` | string | yes | `main`, `spin-off`, `remake` |
| `is_published` | boolean | no | default: true |

**Response `201`** — created game  
**Response `422`** — validation errors  
**Response `401`** — unauthenticated

---

### Update Game
`PUT /api/games/{slug}`  
**Requires:** `Authorization: Bearer {token}`

Same fields as store (all optional for partial updates via PATCH).

**Response `200`** — updated game  
**Response `404`** — not found  
**Response `422`** — validation errors

---

### Delete Game
`DELETE /api/games/{slug}`  
**Requires:** `Authorization: Bearer {token}`

**Response `204`** — no content  
**Response `404`** — not found

---

## Characters

### List Characters
`GET /api/characters`  
Public endpoint. Returns paginated list with game and location relationships.

**Query params:** `per_page` (default: 6)

**Response `200`** — paginated collection

---

### Get Character
`GET /api/characters/{slug}`  
Public endpoint. Includes related game and location.

**Response `200`** — single character  
**Response `404`** — not found

---

### Create Character
`POST /api/characters`  
**Requires:** `Authorization: Bearer {token}`

**Body (JSON)**
```json
{
  "name": "Leon S. Kennedy",
  "slug": "leon-s-kennedy",
  "alias": "Leon",
  "faction": "Independent",
  "status": "alive",
  "nationality": "American",
  "blood_type": "A",
  "height_cm": 180,
  "birth_date": "1977-04-29",
  "is_playable": true,
  "is_published": true,
  "game_id": 1,
  "location_id": 2
}
```

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `name` | string | yes | max 255 |
| `slug` | string | yes | unique |
| `alias` | string | no | |
| `faction` | string | no | `S.T.A.R.S.`, `B.S.A.A.`, `Umbrella`, `Neo-Umbrella`, `The Connections`, `Independent`, `Villain`, `Infected`, `Unknown` |
| `status` | string | no | `alive`, `deceased`, `unknown`, `mutated` |
| `description` | string | no | |
| `nationality` | string | no | max 100 |
| `blood_type` | string | no | max 5 |
| `height_cm` | integer | no | 50–300 |
| `birth_date` | date | no | YYYY-MM-DD |
| `is_playable` | boolean | no | |
| `is_published` | boolean | no | |
| `lore` | string | no | |
| `game_id` | integer | no | must exist in games |
| `location_id` | integer | no | must exist in locations |

**Response `201`** — created character  
**Response `422`** — validation errors

---

### Update Character
`PUT /api/characters/{slug}`  
**Requires:** `Authorization: Bearer {token}`

**Response `200`** — updated character

---

### Delete Character
`DELETE /api/characters/{slug}`  
**Requires:** `Authorization: Bearer {token}`

**Response `204`** — no content

---

## Locations

### List Locations
`GET /api/locations`  
Public endpoint.

**Query params:** `per_page` (default: 6)

**Response `200`** — paginated collection

---

### Get Location
`GET /api/locations/{slug}`  
Public endpoint.

**Response `200`** — single location  
**Response `404`** — not found

---

### Create Location
`POST /api/locations`  
**Requires:** `Authorization: Bearer {token}`

**Body (JSON)**
```json
{
  "name": "Raccoon City",
  "slug": "raccoon-city",
  "region": "Midwest",
  "country": "United States",
  "description": "A fictional city in the Arklay Mountains.",
  "is_published": true
}
```

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| `name` | string | yes | max 255 |
| `slug` | string | yes | unique |
| `region` | string | no | |
| `country` | string | no | max 100 |
| `description` | string | no | |
| `image` | string | no | |
| `is_published` | boolean | no | |

**Response `201`** — created location  
**Response `422`** — validation errors

---

### Update Location
`PUT /api/locations/{slug}`  
**Requires:** `Authorization: Bearer {token}`

**Response `200`** — updated location

---

### Delete Location
`DELETE /api/locations/{slug}`  
**Requires:** `Authorization: Bearer {token}`

**Response `204`** — no content

---

## HTTP Status Codes Summary

| Code | Meaning |
|------|---------|
| `200` | OK — successful read or update |
| `201` | Created — resource successfully created |
| `204` | No Content — successful delete |
| `401` | Unauthenticated — missing or invalid token |
| `404` | Not Found — resource does not exist |
| `422` | Unprocessable Entity — validation failed |

---

## Using the Token in Requests

Include the token in every write request as a Bearer token header:

```
Authorization: Bearer 1|abcdefg...
```

### Example with curl

```bash
# Login
curl -X POST http://localhost/api/auth/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password"}'

# Create a game (replace TOKEN with the value from login)
curl -X POST http://localhost/api/games \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer TOKEN" \
  -d '{"title":"RE4","slug":"re4","release_year":2005,"platform":"GameCube","canon":"main"}'

# List characters
curl http://localhost/api/characters \
  -H "Accept: application/json"
```
