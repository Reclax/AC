/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;

/**
 *
 * @author marco
 */
public class User {
    private String cedula;
    private String nombre;
    private String apellido;
    private String clave;
    private boolean isAdmin;
    
    // Constructor
    public User(String cedula, String nombre, String apellido, String clave, boolean isAdmin) {
        this.cedula = cedula;
        this.nombre = nombre;
        this.apellido = apellido;
        this.clave = clave;
        this.isAdmin = isAdmin;
    }
    
    public String getCedula() { return cedula; }
    public void setCedula(String cedula) { this.cedula = cedula; }
    
    public String getNombre() { return nombre; }
    public void setNombre(String nombre) { this.nombre = nombre; }
    
    public String getApellido() { return apellido; }
    public void setApellido(String apellido) { this.apellido = apellido; }
    
    public String getClave() { return clave; }
    public void setClave(String clave) { this.clave = clave; }
    
    public boolean isEsAdmin() { return isAdmin; }
    public void setEsAdmin(boolean esAdmin) { this.isAdmin = esAdmin; }
}
