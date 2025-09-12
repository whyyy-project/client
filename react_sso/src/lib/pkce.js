// PKCE utilities for public SPA
export async function sha256(plain) {
  const encoder = new TextEncoder();
  const data = encoder.encode(plain);
  const hash = await crypto.subtle.digest('SHA-256', data);
  return new Uint8Array(hash);
}

export function base64UrlEncode(arrayBuffer) {
  let str = btoa(String.fromCharCode.apply(null, [...arrayBuffer]));
  return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
}

export function randomString(len = 43) {
  const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-._~';
  const result = [];
  const values = crypto.getRandomValues(new Uint8Array(len));
  for (let i = 0; i < len; i++) {
    result.push(charset[values[i] % charset.length]);
  }
  return result.join('');
}

export async function createPkce() {
  const verifier = randomString(64);
  const challenge = base64UrlEncode(await sha256(verifier));
  return { verifier, challenge };
}
