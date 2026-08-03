# CLAUDE.md — seatplus/esi-client

Guidance for Claude Code working in this package on its own (e.g. opened as a
standalone Orca project). A standalone checkout does **not** inherit the core
app's `CLAUDE.md`, skills, or MCP — this file is the local pointer.

## What this is
**esi-client** — a standalone Guzzle HTTP client for the EVE Swagger Interface
(ESI) with RFC 7234 response caching. It's the **bottom** of the seatplus one-way
dependency chain and has **no internal dependencies**:

```
esi-client → eveapi → auth → web
```

Nothing here may import from `eveapi`/`auth`/`web`. The full project — the other
packages, the domain rules, and the shared `.claude/skills/` — lives in the core
app repo **[seatplus/core](https://github.com/seatplus/core)**, whose `CLAUDE.md`
is the authoritative source of truth. laravel-boost, the browser MCP, and any
frontend work only apply there, not in this package.

## Testing
No database or Redis needed — this is a pure HTTP client.

```bash
composer run test        # Pint (lint) + PHPStan + 100% type-coverage + Pest
vendor/bin/pest --filter "test name"
```

100% type coverage and PHPStan are enforced; Pint keeps PSR-12.

## Code style
Follow the [Spatie PHP guidelines](https://spatie.be/guidelines/laravel): strict
types, explicit return types, constructor property promotion, curly braces always,
early-return happy-path. New PHP files omit a license header — match the newest
sibling files, not the oldest.
