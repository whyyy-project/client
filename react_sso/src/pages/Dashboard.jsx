import { useEffect, useState } from 'react'

export default function Dashboard() {
  const [user, setUser] = useState(null)

  useEffect(() => {
    const u = localStorage.getItem('user')
    if (u) setUser(JSON.parse(u))
  }, [])

  if (!user) {
    return (
      <div className="container">
        <div className="card">
          <h2>Dashboard</h2>
          <p className="msg err">Belum login. Silakan kembali ke beranda.</p>
          <p><a className="btn" href="/">Kembali</a></p>
        </div>
      </div>
    )
  }

  const role = user.role || (Array.isArray(user.roles) ? user.roles[0] : 'mahasiswa')

  return (
    <div className="container">
      <div className="card">
        <h2>Dashboard ({role?.toUpperCase()})</h2>
        <p>Halo, <strong>{user.name}</strong></p>
        <p>Email: {user.email}</p>
        <p>Role: <span className="badge">{role}</span></p>

        {role === 'pegawai' && (
          <>
            <h3>Menu Pegawai</h3>
            <ul>
              <li>Rekap Presensi</li>
              <li>Pengajuan Cuti</li>
            </ul>
          </>
        )}

        {role === 'dosen' && (
          <>
            <h3>Menu Dosen</h3>
            <ul>
              <li>RPS & Nilai</li>
              <li>Jadwal Mengajar</li>
            </ul>
          </>
        )}

        {role !== 'pegawai' && role !== 'dosen' && (
          <>
            <h3>Menu Mahasiswa</h3>
            <ul>
              <li>KRS & KHS</li>
              <li>Jadwal Kuliah</li>
            </ul>
          </>
        )}

        <p style={{marginTop: 16}}>
          <a className="btn" style={{background:'#64748b'}} href="/">Beranda</a>
          <a className="btn" style={{marginLeft: 8}} href="#" onClick={() => { localStorage.clear(); window.location.href='/'; }}>Logout</a>
        </p>
      </div>
    </div>
  )
}
