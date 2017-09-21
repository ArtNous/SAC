USE [CAVENIDA]
GO
/****** Object:  Table [dbo].[Clientes]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Clientes](
	[CodigoCliente] [char](20) NOT NULL,
	[Nombre] [char](150) NOT NULL,
	[RazonSocial] [char](100) NULL,
	[RIF] [char](22) NULL,
	[NIT] [char](22) NULL,
	[DocumentoFiscal] [char](1) NULL,
	[Direccion] [text] NULL,
	[DireccionEnvio] [text] NULL,
	[Ciudad] [char](30) NULL,
	[Estado] [char](30) NULL,
	[Municipio] [char](30) NULL,
	[email] [char](50) NULL,
	[Telefonos] [char](100) NULL,
	[Fax] [char](30) NULL,
	[CodigoGrupo] [char](5) NOT NULL,
	[Zona] [char](20) NULL,
	[LimiteCredito] [money] NULL,
	[Estatus] [char](2) NULL,
	[Transporte] [char](5) NULL,
	[Descuento] [smallmoney] NULL,
	[Observaciones] [char](100) NULL,
	[RegimenIVA] [char](1) NULL,
	[PorcentajeIVA] [smallmoney] NULL CONSTRAINT [DF__Clientes__Porcen__09FE775D]  DEFAULT ((0)),
	[Tarifa] [char](5) NULL,
	[TipoCredito] [char](5) NULL,
	[PersonaContacto] [char](30) NULL,
	[Vendedor] [char](5) NULL,
	[Cobrador] [char](5) NULL,
	[BancoDomicilia] [char](25) NULL,
	[CuentaDomicilia] [char](20) NULL,
	[TitularDomicilia] [char](80) NULL,
	[CodigoContable] [char](30) NULL,
	[FechaRegistro] [datetime] NULL,
	[DiasVisita] [char](6) NULL,
	[DiasEntrega] [char](12) NULL,
	[Empresa] [char](3) NULL,
	[Saldo] [money] NULL CONSTRAINT [DF_Clientes_Saldo]  DEFAULT ((0)),
	[ultimopago] [datetime] NULL,
	[Registro] [int] IDENTITY(1,1) NOT NULL,
	[Sucursal] [char](3) NULL,
	[TdcNumero] [char](20) NULL,
	[TdcTitular] [char](50) NULL,
	[TdcMesVcto] [char](2) NULL,
	[TdcAnoVcto] [char](4) NULL,
	[TdcNumSeguridad] [char](3) NULL,
	[PotencialVenta] [money] NULL,
	[Cliente_id] [char](15) NULL,
	[TarifaServicios] [char](5) NULL,
	[PaginaWEB] [char](100) NULL,
	[Twitter] [char](100) NULL,
	[Facebook] [char](100) NULL,
	[CodigoProveedor] [char](20) NULL,
	[Nacional] [bit] NULL,
 CONSTRAINT [PK_Clientes] PRIMARY KEY CLUSTERED 
(
	[CodigoCliente] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Marca]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Marca](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_Marca] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_Marca] UNIQUE NONCLUSTERED 
(
	[nombre] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Modelo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Modelo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](20) NOT NULL,
	[marca] [int] NOT NULL,
 CONSTRAINT [PK_Modelo] PRIMARY KEY CLUSTERED 
(
	[id] ASC,
	[nombre] ASC,
	[marca] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[OrdenServicio]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[OrdenServicio](
	[nro_orden] [int] IDENTITY(1,1) NOT NULL,
	[cod_cliente] [nchar](15) NOT NULL,
	[placa] [nchar](10) NOT NULL,
	[fecha] [date] NOT NULL,
	[cod_vendedor] [varchar](5) NOT NULL,
	[fecha_inicio] [datetime] NULL,
	[fecha_final] [datetime] NULL,
	[servicio] [varchar](5) NOT NULL,
	[estatus] [int] NOT NULL,
	[tecnico] [varchar](15) NULL,
	[posicion_inicial] [int] NULL,
	[posicion_final] [int] NULL,
 CONSTRAINT [PK_OrdenServicio] PRIMARY KEY CLUSTERED 
(
	[nro_orden] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Servicios]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Servicios](
	[codigo] [varchar](5) NOT NULL,
	[nombre] [varchar](30) NOT NULL,
	[descripcion] [varchar](60) NULL,
	[prox_km] [float] NULL,
 CONSTRAINT [PK_Servicios] PRIMARY KEY CLUSTERED 
(
	[codigo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_Servicios] UNIQUE NONCLUSTERED 
(
	[nombre] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Tecnicos]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Tecnicos](
	[cedula] [varchar](15) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[estatus] [char](10) NULL,
	[codigoINT] [char](14) NOT NULL,
 CONSTRAINT [PK_Tecnicos] PRIMARY KEY CLUSTERED 
(
	[cedula] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TecnicoServicio]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TecnicoServicio](
	[servicio] [varchar](6) NOT NULL,
	[cedula_tecnico] [varchar](10) NOT NULL,
 CONSTRAINT [PK_TecnicoServicio] PRIMARY KEY CLUSTERED 
(
	[servicio] ASC,
	[cedula_tecnico] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TiempoAtencion]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TiempoAtencion](
	[servicio] [varchar](50) NOT NULL,
	[tipo_vehiculo] [int] NOT NULL,
	[tiempo] [int] NOT NULL,
 CONSTRAINT [PK_TiempoAtencion] PRIMARY KEY CLUSTERED 
(
	[servicio] ASC,
	[tipo_vehiculo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TipoVehiculo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TipoVehiculo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](15) NOT NULL,
 CONSTRAINT [PK_TipoVehiculo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_TipoVehiculo] UNIQUE NONCLUSTERED 
(
	[descripcion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[usuarios]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[usuarios](
	[cedula] [varchar](15) NOT NULL,
	[usuario] [varchar](20) NOT NULL,
	[password] [varchar](70) NOT NULL,
	[email] [varchar](50) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Vehiculo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Vehiculo](
	[placa] [varchar](10) NOT NULL,
	[modelo] [int] NOT NULL,
	[marca] [int] NOT NULL,
	[tipo_vehiculo] [int] NOT NULL,
	[cliente] [char](22) NULL,
	[km_actual] [float] NULL,
 CONSTRAINT [PK_Vehiculo] PRIMARY KEY CLUSTERED 
(
	[placa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Vehiculo]  WITH CHECK ADD  CONSTRAINT [FK_Cliente_Vehiculo] FOREIGN KEY([placa])
REFERENCES [dbo].[Vehiculo] ([placa])
GO
ALTER TABLE [dbo].[Vehiculo] CHECK CONSTRAINT [FK_Cliente_Vehiculo]
GO
