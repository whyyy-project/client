export const SSO_BASE_URL = import.meta.env.VITE_SSO_BASE_URL?.replace(/\/$/, '')
export const CLIENT_ID = import.meta.env.VITE_CLIENT_ID
export const CLIENT_SECRET = import.meta.env.VITE_CLIENT_SECRET
export const REDIRECT_URI = import.meta.env.VITE_REDIRECT_URI

export function buildAuthorizeUrl({ state, codeChallenge }) {
  const p = new URLSearchParams({
    client_id: CLIENT_ID,
    redirect_uri: REDIRECT_URI,
    response_type: 'code',
    state,
    code_challenge: codeChallenge,
    code_challenge_method: 'S256',
  })
  return `${SSO_BASE_URL}/auth?${p.toString()}`
}

export async function exchangeCode({ code, codeVerifier }) {
  const resp = await fetch(`${SSO_BASE_URL}/api/token`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded', Accept: 'application/json' },
    body: new URLSearchParams({
      grant_type: 'authorization_code',
      client_id: CLIENT_ID,
      ...(CLIENT_SECRET ? { client_secret: CLIENT_SECRET } : {}),
      redirect_uri: REDIRECT_URI,
      code,
      code_verifier: codeVerifier,
    }),
  })
  const data = await resp.json().catch(() => ({}))
  if (!resp.ok) {
    throw new Error(data.message || data.error || `HTTP ${resp.status}`)
  }
  return data
}

export async function fetchMe(accessToken) {
  const resp = await fetch(`${SSO_BASE_URL}/api/me`, {
    headers: { Authorization: `Bearer ${accessToken}`, Accept: 'application/json' },
  })
  const data = await resp.json().catch(() => ({}))
  if (!resp.ok) {
    throw new Error(data.message || data.error || `HTTP ${resp.status}`)
  }
  return data
}
