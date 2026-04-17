# codevenom/fakturownia-bundle
<p align="center">
  <a href="https://github.com/codevenom-co/fakturownia-bundle">
    <img src="./docs/github-banner.svg" alt="CODEVENOM Fakturownia Bundle - Symfony package with MCP tools" width="100%" />
  </a>
</p>

Symfony bundle for the Fakturownia API with built-in MCP tools.

## What This Gives You

- Fakturownia integration as a standard Symfony service (`FakturowniaClient`).
- Ready-to-use MCP tools that can be exposed to any AI agent through `symfony/mcp-bundle`.
- A single Composer package, without a separate MCP microservice.

## Available MCP Tools (v1)

- `list_invoices`
- `get_invoice`
- `create_invoice`
- `list_clients`
- `create_client`
- `invoice_payment_status`

## Requirements

- PHP 8.2+
- Symfony 6.4+ or 7.x
- `symfony/mcp-bundle` (`stdio` and/or HTTP transport)

## Installation

```bash
composer require codevenom/fakturownia-bundle symfony/mcp-bundle
```

## Symfony Configuration

`config/packages/codevenom_fakturownia.yaml`

```yaml
codevenom_fakturownia:
  base_url: '%env(FAKTUROWNIA_BASE_URL)%' # e.g. https://your-subdomain.fakturownia.pl
  api_token: '%env(FAKTUROWNIA_API_TOKEN)%'
  timeout: 15
```

`.env`

```dotenv
FAKTUROWNIA_BASE_URL=https://your-subdomain.fakturownia.pl
FAKTUROWNIA_API_TOKEN=your_api_token
```

`config/routes.yaml`

```yaml
mcp:
  resource: .
  type: mcp
```

`config/packages/mcp.yaml`

```yaml
mcp:
  app: 'shardn'
  version: '1.0.0'
  description: 'SHARDN MCP + Fakturownia tools'
  client_transports:
    stdio: true
    http: true
```

## Run MCP Server (stdio)

```bash
php bin/console mcp:server
```

This is the command you register as an MCP server in the client (e.g. Codex/VS Code).

## Example MCP Client Configuration (STDIO)

```json
{
  "mcpServers": {
    "shardn-fakturownia": {
      "command": "php",
      "args": ["/abs/path/to/project/bin/console", "mcp:server"],
      "env": {
        "APP_ENV": "prod",
        "FAKTUROWNIA_BASE_URL": "https://your-subdomain.fakturownia.pl",
        "FAKTUROWNIA_API_TOKEN": "***"
      }
    }
  }
}
```

## Note About MCP Capability Auto-Discovery

`symfony/mcp-bundle` discovers capabilities via attributes (`#[McpTool]`).
In most setups, it is enough that the attributed service is loaded by the container.

If vendor capabilities are not automatically discovered in your app, add a small bridge class in the app `src/` that delegates to `Codevenom\\FakturowniaBundle\\Mcp\\FakturowniaMcpTools`.

## Product Strategy

This package is both a library and MCP integration:
- as a library: you can use `FakturowniaClient` without AI,
- as MCP: you expose the same use cases to AI agents through the MCP standard.

This lets you deploy the bundle in SHARDN while also publishing it as a public CODEVENOM OSS package.


## Development

If you have Docker and [Task](https://taskfile.dev/) installed, you can easily run tests and tools:

```bash
task install
task test
task cs-fix
```